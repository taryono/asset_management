<?php

namespace App\Modules\Income\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreIncome;
use Lib\File;
use Models\Income as income;

class IncomeController extends MainController
{
    public function __construct()
    {
        parent::__construct(new income(), 'income');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Income::index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category($category)
    {
        return view('Income::index', ['category' => $category]);
    }

    public function getListAjax()
    {
        $category = request()->input('category');
        if (request()->ajax()) {
            $incomes = $this->_model::with(['income_category', 'income_type'])->select('*');
            return datatables()->of($incomes)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('income.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('income.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('income.destroy', $row->id), 'preview' => route('income.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;
                    }
                })
                ->addColumn('date', function ($row) {
                    if ($row) {
                        return dateToInd($row->date);
                    }
                })
                ->addColumn('amount', function ($row) {
                    if ($row) {
                        return rupiahFormat($row->amount);
                    }
                })->addColumn('material', function ($row) {
                if ($row) {
                    if ($row->material_type) {
                        return $row->material_type->name;
                    }
                    return null;
                }
            })->addColumn('from', function ($row) {
                if ($row) {
                    if ($row->from_type) {
                        return $row->from_type->name;
                    }
                    return null;
                }
            })->addColumn('type', function ($row) {
                if ($row) {
                    return '<button class="button btn-' . $row->income_type->bg_color . '">' . ($row->income_type ? $row->income_type->name : "-") . '</button>';
                }
            })
                ->addColumn('category', function ($row) {
                    if ($row) {
                        return '<button class="button btn-' . $row->income_category->bg_color . '">' . (($row->income_category) ? $row->income_category->name : "-") . '</button>';
                    }
                })
                ->rawColumns(['action', 'description', 'type', 'category'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Income::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncome $request)
    {
        try {
            $income = $this->_model::create($this->_serialize($request));

            if (request()->file('photo')) {
                $this->validate($request, [
                    'nota' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                if (request()->file('nota')->isValid()) {
                    $file = request()->file('nota');
                    // image upload in storage/app/public/nota
                    $info = File::storeLocalFile($file, File::createLocalDirectory(storage_path('app/public/nota')));
                    if ($income->nota && file_exists(storage_path('app/public/nota/' . $income->nota))) {
                        unlink(storage_path('app/public/nota/' . $income->nota));
                    }
                    $income->nota = is_object($info) ? $info->getFilename() : $info;
                    $income->save();
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Image not allowed to upload.'], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('income.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show($income_id)
    {
        $income = $this->_model::find($income_id);
        return view('Income::show', ['income' => $income]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function preview($income_id)
    {
        $income = $this->_model::find($income_id);
        return view('Income::preview', ['income' => $income]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit($income_id)
    {
        $income = $this->_model::find($income_id);
        return view('Income::edit', ['income' => $income]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update($income_id)
    {
        try {
            $income = $this->_model::find($income_id);

            if ($income) {
                $income->update($this->_serialize(request()));
                if (request()->file('photo')) {
                    $this->validate(request(), [
                        'nota' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    if (request()->file('nota')->isValid()) {
                        $file = request()->file('nota');
                        // image upload in storage/app/public/nota
                        $info = File::storeLocalFile($file, File::createLocalDirectory(storage_path('app/public/nota')));
                        if ($income->nota && file_exists(storage_path('app/public/nota/' . $income->nota))) {
                            unlink(storage_path('app/public/nota/' . $income->nota));
                        }
                        $income->nota = is_object($info) ? $info->getFilename() : $info;
                        $income->save();
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'Image not allowed to upload.'], 200);
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('income.index')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy($income_id)
    {
        try {
            $income = $this->_model::find($income_id);
            if ($income) {
                $income->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('income.index')], 200);
    }

    public function search()
    {
    }
}
