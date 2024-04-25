<?php

namespace App\Http\Controllers\Back;

use App\Models\Pages;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LegalController extends Controller
{

    /**
     *  Legal information
     */

    public function showTest()
    {
        $data = [];
        $data['group'] = 'legal';
        $data['page'] = 'test';
        return view('pages.backend.settings.first', $data);
    }

    public function showAbout()
    {
        $data = [];
        $data['group'] = 'legal';
        $data['page'] = 'about';
        $data['pageContent'] = Pages::where('key', 'about')->first();
        return view('pages.backend.settings.about', $data);
    }

    public function postAbout(Request $request)
    {
        $page = Pages::where('key', 'about')->first();
        if ($page) {
            $page->content = $request->page_content;
            if ($page->update()) {
                return redirect()->route('about');
            }
        } else {
            $p = new Pages;
            $p->key = 'about';
            $p->content = $request->page_content;
            if ($p->save()) {
                return redirect()->route('about');
            }
        }
    }

    public function showLegal()
    {
        $data = [];
        $data['group'] = 'legal';
        $data['page'] = 'legal';
        $data['pageContent'] = Pages::where('key', 'legal')->first();
        return view('pages.backend.settings.legal-mentions', $data);
    }

    public function postLegal(Request $request)
    {
        $page = Pages::where('key', 'legal')->first();
        if ($page) {
            $page->content = $request->page_content;
            if ($page->update()) {
                return redirect()->route('legal');
            }
        } else {
            $p = new Pages;
            $p->key = 'legal';
            $p->content = $request->page_content;
            if ($p->save()) {
                return redirect()->route('legal');
            }
        }
    }

    public function showConfidential()
    {
        $data = [];
        $data['group'] = 'legal';
        $data['page'] = 'confidential';
        $data['pageContent'] = Pages::where('key', 'confidential')->first();
        return view('pages.backend.settings.confidential', $data);
    }

    public function postConfidential(Request $request)
    {
        $page = Pages::where('key', 'confidential')->first();
        if ($page) {
            $page->content = $request->page_content;
            if ($page->update()) {
                return redirect()->route('confidential');
            }
        } else {
            $p = new Pages;
            $p->key = 'confidential';
            $p->content = $request->page_content;
            if ($p->save()) {
                return redirect()->route('confidential');
            }
        }
    }

    public function showCGV()
    {
        $data = [];
        $data['group'] = 'legal';
        $data['page'] = 'cgv';
        $data['pageContent'] = Pages::where('key', 'cgv')->first();
        return view('pages.backend.settings.cgv', $data);
    }

    public function postCGV(Request $request)
    {
        $page = Pages::where('key', 'cgv')->first();
        if ($page) {
            $page->content = $request->page_content;
            if ($page->update()) {
                return redirect()->route('cgv');
            }
        } else {
            $p = new Pages;
            $p->key = 'cgv';
            $p->content = $request->page_content;
            if ($p->save()) {
                return redirect()->route('cgv');
            }
        }
    }

    public function showFaq()
    {
        $data = [];
        $data['group'] = 'legal';
        $data['page'] = 'faq';
        $data['pageContent'] = Pages::where('key', 'faq')->first();
        return view('pages.backend.settings.faq', $data);
    }

    public function postFaq(Request $request)
    {
        $page = Pages::where('key', 'faq')->first();
        if ($page) {
            $page->content = $request->page_content;
            if ($page->update()) {
                return redirect()->route('faq');
            }
        } else {
            $p = new Pages;
            $p->key = 'faq';
            $p->content = $request->page_content;
            if ($p->save()) {
                return redirect()->route('faq');
            }
        }
    }
}
