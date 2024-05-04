<?php

namespace App\Traits;

trait GlobalMutators
{

    /**
     * getNameEnAttribute
     *
     * @return string|null
     */
    public function getNameEnAttribute()
    {
        return optional(json_decode($this->attributes['name']))->en ?? '';
    }

    /**
     * getNameArAttribute
     *
     * @return string|null
     */
    public function getNameArAttribute()
    {
        return optional(json_decode($this->attributes['name']))->ar ?? '';
    }

    /**
     * getTitleEnAttribute
     *
     * @return string|null
     */
    public function getTitleEnAttribute()
    {
        return optional(json_decode($this->attributes['title']))->en ?? '';
    }

    /**
     * getTitleArAttribute
     *
     * @return string|null
     */
    public function getTitleArAttribute()
    {
        return optional(json_decode($this->attributes['title']))->ar ?? '';
    }

    /**
     * getDescriptionEnAttribute
     *
     * @return string|null
     */
    public function getDescriptionEnAttribute()
    {
        return optional(json_decode($this->attributes['description']))->en ?? '';
    }

    /**
     * getDescriptionArAttribute
     *
     * @return string|null
     */
    public function getDescriptionArAttribute()
    {
        return optional(json_decode($this->attributes['description']))->ar ?? '';
    }

    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }
}
