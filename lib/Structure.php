<?php

namespace Lib;

use Illuminate\Database\Eloquent\Collection;

#use Illuminate\Support\Facades\Redis;

class Structure
{
    public $childrens = [];
    public $structure_id = 1;
    public $total = 0;

    public function __construct($structure_id = NULL)
    {
        $this->structure_id = $structure_id;
    }

    public function getStructureId()
    {
        return (Session()->get('structure_id')) ? Session()->get('structure_id') : $this->structure_id;
    }

    public function getTotalData()
    {
        if (!$this->getStructureId()) {
            $generation = \Models\Structure::first();
            $users = \App\Models\User::whereHas('user_generation', function ($q) use ($generation) {
                $q->whereIn('generation_status_id', [1, 2]);
            })->get();
        } else {
            $users = \App\Models\User::whereHas('user_generation', function ($q) {
                $q->whereIn('generation_status_id', [1, 2]);
                $q->where('structure_id', $this->getStructureId());
            })->get();
        }
        $data = [
            'total' => 1,
        ];
        if ($users->count() > 0) {
            $user_ids = [];
            foreach ($users as $user) {
                $user_ids[] = $user->id;
            }
            return $data = [
                'total' => $users->count(),
            ];
        }
        return $data;
    }

    public function extractKeys($users)
    {
        $keys = [];
        foreach ($users as $user) {
            if (is_array($user)) {
                $keys[] = $this->extractKeys(array_values($user));
            } else {
                $keys[] = $user;
            }
        }

        return array_filter($keys);
    }

    public function getChildrens()
    {
        return $this->childrens;
    }

    public function getData()
    {
        $graph = [
            'id' => NULL,
            'name' => 'Ketua Umum',
            'title' => 'Nama Jabatan',
            'children' => NULL,
            'className' => NULL,
            'structureId' => $this->getStructureId(),
        ];
        $staff = \Models\Staff::whereHas('position', function ($q) {
            $q->where('parent_id', 0)->where('type', 2);
        })->where('structure_id', $this->getStructureId())->first();
        if ($staff) {
            $graph = [
                'id' => $staff->id,
                'name' => $staff->people->name,
                'title' => $staff->position->name,
                'children' => [],
                'className' => NULL,
                'structureId' => $this->getStructureId(),
            ];
        }
        $graph['children'] = $this->generateChildren($staff);
        return $graph;
    }

    public function storeGraphToDatabase($graph, $type, $key = FALSE)
    {
        $tree = \Models\Tree::where([
            'structure_id' => $this->getStructureId(),
            'type' => $type
        ])->first();
        if (!$tree) {
            \Models\Tree::create([
                'structure_id' => $this->getStructureId(),
                'content' => json_encode($graph),
                'total' => count($this->getChildrens()),
                'type' => $type
            ]);
        } else {
            $tree->update([
                'content' => json_encode($graph),
                'total' => count($this->getChildrens()),
                'type' => $type
            ]);
        }
    }

    public function generateChildren($parent)
    {
        $graphs = [];
        $graph = [
            'id' => [],
            'name' => [],
            'title' => [],
            'structureId' => $this->getStructureId(),
            'children' => [],
        ];
        $staffs = \Models\Staff::whereHas('position', function ($q) use ($parent) {
            $q->where('parent_id', $parent->position_id)->where('type', 2);
        })->where('structure_id', $this->getStructureId())->get();

        if ($staffs->count() > 0) {
            foreach ($staffs as $staff) {
                $graph['id'] = $staff->id;
                $graph['name'] = $staff->people->name;
                $graph['title'] = $staff->position->name;
                $graph['children'] = $this->generateChildren($staff);
                if (count($graph['children']) < 1) {
                    unset($graph['children']);
                }
                $graphs[] = $graph;
            }
        }
        return $graphs;
    }

    public function getTreeData()
    {
        $key = $this->getStructureId() . "tree";

        return $graph = [
            'id' => NULL,
            'text' => Session()->get('name'),
            'title' => 'Nama Jabatan',
            'children' => NULL,
            'className' => NULL,
            'structureId' => $this->getStructureId(),
        ];

        $tree = \Models\Tree::where([
            'structure_id' => $this->getStructureId(),
            'type' => 'tree'
        ])->first();
        $user_structures = new Collection();
        if ($tree) {
            if ($user_structures) {
                if ($user_structures->count() === $tree->total) {
                    if (!empty($tree->content)) {
                        return $tree->content;
                    }
                }
            }
        }

        $graph = [
            'id' => NULL,
            'text' => Session()->get('name'),
            'title' => 'Nama Jabatan',
            'children' => NULL,
            'className' => NULL,
            'structureId' => $this->getStructureId(),
        ];

        $this->storeGraphToDatabase($graph, 'tree', $key);
        return $graph;
    }
}
