<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model {
    protected $fillable = [
        'l', 'lang', 'list', 'nativ', 'tempus1', 'tempus2', 'tempus3', 'tempus4', 'tempus5', 'tempus6', 'appld', 'flurryld', 'bundleld', 'noTempus', 'pronom1', 'pronom2', 'pronom3', 'pronom4', 'pronom5', 'pronom6', 'flippable'
    ];
}
