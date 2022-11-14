<?php 
namespace Models;

use App\Models\User;
use Laravel\Scout\Searchable;

class Post extends BasedModel
{   
    use Searchable;
    public $appends = ['slug','date']; 
    
    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'posts_index';
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();
 
        // Customize the data array...
 
        return $array;
    }

    /**
     * Get the value used to index the model.
     *
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->title;
    }
 
    /**
     * Get the key name used to index the model.
     *
     * @return mixed
     */
    public function getScoutKeyName()
    {
        return 'title';
    }
    
    public function getSlugAttribute(){
        return str_replace(" ","-",strtolower($this->title));
    } 

    public function getDateAttribute(){
        return date("Ymd", strtotime($this->publish_date));
    } 
 

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function template(){
        return $this->belongsTo(Template::class);
    }

    public function page(){
        return $this->hasOne(Page::class);
    }

    public function post_status(){
        return $this->belongsTo(PostStatus::class);
    } 

    public function child(){
        return Post::class;
    }
}