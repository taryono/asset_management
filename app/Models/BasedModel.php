<?php

namespace Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BasedModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    //add this code in model
    public function scopeSearch($query, $keyword, $columns = [], $relationMapping = [])
    {   // if you pass empty column list then it automatically get all table column or fillable column
        if (empty($columns)) {
            // 1) get all table column 
            //  $columns = array_except( Schema::getColumnListing($this->table), $this->guarded);
            // 2) get fillable column
            $columns = $this->fillable;
        }

        $query->where(function ($query) use ($keyword, $columns, $relationMapping) {
            foreach ($columns as $key => $column) {
                $clause = $key == 0 ? 'where' : 'orWhere';
                $query->$clause($this->table . '.' . $column, "LIKE", "%{$keyword}%");

                if (!empty($relationMapping)) {
                    $this->filterByRelationship($query, $keyword, $relationMapping);
                }
            }
        });
        return $query;
    }

    private function filterByRelationship($query, $keyword, $relativeTables)
    {
        foreach ($relativeTables as $relationship => $relativeColumns) {
            $query->orWhereHas($relationship, function ($relationQuery) use ($keyword, $relativeColumns) {
                foreach ($relativeColumns as $key => $column) {
                    $clause = $key == 0 ? 'where' : 'orWhere';
                    $relationQuery->$clause($column, "LIKE", "%$keyword%");
                }
            });
        }
        return $query;
    }

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($model) {
            if ($model instanceof Employee) {
                $model->name = $model->first_name . " " . $model->last_name;
            }

            if ($model instanceof Post) {
                $model->month = date('n', strtotime($model->created_at));
                $model->year = date('Y', strtotime($model->created_at));
                $model->template_id = 7;
            }

            if ($model instanceof Page) {
                $model->month = date('n', strtotime($model->created_at));
                $model->year = date('Y', strtotime($model->created_at));
                $model->template_id = 6;
            }

            if ($model instanceof Income) {
                $model->month = date('n', strtotime($model->date));
                $model->year = date('Y', strtotime($model->date));
                $model->template_id = 5;
            }

            if ($model instanceof Gallery) {
                $model->month = date('n', strtotime($model->date));
                $model->year = date('Y', strtotime($model->date));
                $model->template_id = 4;
            }

            if ($model instanceof Expenditure) {
                $model->month = date('n', strtotime($model->created_at));
                $model->year = date('Y', strtotime($model->created_at));
                $model->template_id = 3;
            }

            if ($model instanceof Event) {
                $model->month = date('n', strtotime($model->created_at));
                $model->year = date('Y', strtotime($model->created_at));
                $model->template_id = 2;
            }

            if ($model instanceof Album) {
                $model->month = date('n', strtotime($model->created_at));
                $model->year = date('Y', strtotime($model->created_at));
                $model->template_id = 1;
            }

            if ($model instanceof Schedule) {
                $model->month = date('n', strtotime($model->created_at));
                $model->year = date('Y', strtotime($model->created_at));
                $model->template_id = 1;
            }
        });

        static::updating(function ($model) {
            if ($model instanceof Employee) {
                $model->name = $model->first_name . " " . $model->last_name;
            }
        });

        static::deleting(function ($model) {

        });

    }

}
