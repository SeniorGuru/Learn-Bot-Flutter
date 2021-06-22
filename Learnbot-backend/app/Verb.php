<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Verb extends Model {
    protected $fillable = [
        'id', 'lang', 'english', 'infinitiv_text', 'infinitiv_text_translit', 'idx', 'image_768x1024', 'infinitiv_audio', 'conj1_text', 'conj1_audio', 'conj2_text', 'conj2_audio', 'conj3_text', 'conj3_audio', 'conj4_text', 'conj4_audio', 'conj5_text', 'conj5_audio', 'conj6_text', 'conj6_audio', 'conj7_text', 'conj7_audio', 'conj8_text', 'conj8_audio', 'conj9_text', 'conj9_audio', 'conj10_text', 'alfa', 'favorite'
    ];

    protected $primaryKey = "id";
}
