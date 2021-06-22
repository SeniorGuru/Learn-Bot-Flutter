<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Verb;
use App\Word;

class VerbController extends Controller {
    public function readAllofLang(Request $request) {
        $lang = $request->lang;

        $verbs = Verb::select('infinitiv_text','lang','english')->where('lang', '=', $lang)->orderBy("infinitiv_text","ASC")->get();
        return response()->json(['status' => 'success', 'data' => $verbs]);
    }

    public function readOfInfinitiv(Request $request) {
        $lang = $request->lang;
        $infinitiv = $request->infinitiv;

        // $audio = "../../assets/images/tool/assets_icons_audio_play.png";
        $tempus = Word::select('tempus1', 'tempus2', 'tempus3', 'tempus4', 'tempus5', 'tempus6')->where('l', '=', $lang)->first();


        $pronom = Word::select('pronom1', 'pronom2', 'pronom3', 'pronom4', 'pronom5', 'pronom6')->where('l', '=', $lang)->first();

        $present_simple = Verb::select('conj1_text', 'conj1_audio', 'conj2_text', 'conj2_audio', 'conj3_text', 'conj3_audio', 'conj4_text', 'conj4_audio', 'conj5_text', 'conj5_audio', 'conj6_text', 'conj6_audio');
        $past_continuous = Verb::select('conj7_text', 'conj7_audio', 'conj8_text', 'conj8_audio', 'conj9_text', 'conj9_audio', 'conj10_text', 'conj10_audio', 'conj11_text', 'conj11_audio', 'conj12_text', 'conj12_audio');
        $past_simple = Verb::select('conj13_text', 'conj13_audio', 'conj14_text', 'conj14_audio', 'conj15_text', 'conj15_audio', 'conj16_text', 'conj16_audio', 'conj17_text', 'conj17_audio', 'conj18_text', 'conj18_audio');
        $future = Verb::select('conj19_text', 'conj19_audio', 'conj20_text', 'conj20_audio', 'conj21_text', 'conj21_audio', 'conj22_text', 'conj22_audio', 'conj23_text', 'conj23_audio', 'conj24_text', 'conj24_audio');
        $conditional = Verb::select('conj25_text', 'conj25_audio', 'conj26_text', 'conj26_audio', 'conj27_text', 'conj27_audio', 'conj28_text', 'conj28_audio', 'conj29_text', 'conj29_audio', 'conj30_text', 'conj30_audio');
        $present_perfect = Verb::select('conj31_text', 'conj31_audio', 'conj32_text', 'conj32_audio', 'conj33_text', 'conj33_audio', 'conj34_text', 'conj34_audio', 'conj35_text', 'conj35_audio', 'conj36_text', 'conj36_audio');
        $video_image = Verb::select('idx','image_768x1024');
        $current_word = Verb::select('infinitiv_text')->where('lang','=',$lang)->where('english', '=', $infinitiv)->first();

        $present_simple_verbs = $present_simple->where('lang', '=', $lang)->where('english', '=', $infinitiv)->first();
        $past_continuous_verbs = $past_continuous->where('lang', '=', $lang)->where('english', '=', $infinitiv)->first();
        $past_simple_verbs = $past_simple->where('lang', '=', $lang)->where('english', '=', $infinitiv)->first();
        $future_verbs = $future->where('lang', '=', $lang)->where('english', '=', $infinitiv)->first();
        $conditional_verbs = $conditional->where('lang', '=', $lang)->where('english', '=', $infinitiv)->first();
        $present_perfect_verbs = $present_perfect->where('lang', '=', $lang)->where('english', '=', $infinitiv)->first();
        $video_image = $video_image->where('lang', '=', $lang)->where('english', '=', $infinitiv)->first();

        return response()->json(
            [
                'status'                => 'success',
                'tempus'                => $tempus,
                'pronom'                => $pronom,
                'present_simple_verbs'  => $present_simple_verbs,
                'past_continuous_verbs' => $past_continuous_verbs,
                'past_simple_verbs'     => $past_simple_verbs,
                'future_verbs'          => $future_verbs,
                'conditional_verbs'     => $conditional_verbs,
                'present_perfect_verbs' => $present_perfect_verbs,
                'current_word'          => $current_word,
                'video_image'           => $video_image
            ]
        );
    }
}
