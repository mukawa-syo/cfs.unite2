<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    /**
     * Display the FAQ page
     */
    public function faq()
    {
        $faqs = [
            [
                'question' => 'Uknight Cloudとは何ですか？',
                'answer' => 'Uknight Cloudは、地域のつながりと多様な挑戦を応援するクラウドファンディングプラットフォームです。夢を現実にするための支援を集めることができます。'
            ],
            [
                'question' => 'プロジェクトを投稿するにはどうすればよいですか？',
                'answer' => 'アカウントを作成後、「プロジェクトを作成」ボタンから新しいプロジェクトを投稿できます。プロジェクトの詳細、目標金額、期間などを設定してください。'
            ],
            [
                'question' => '支援はどのように行いますか？',
                'answer' => '気になるプロジェクトを見つけたら、「支援する」ボタンをクリックし、支援金額を選択してください。クレジットカードまたは銀行振込でお支払いいただけます。'
            ],
            [
                'question' => '支援金の返金は可能ですか？',
                'answer' => 'プロジェクトが目標金額に達しなかった場合、支援金は全額返金されます。目標達成後は、プロジェクトの進行状況に応じてリターンが提供されます。'
            ],
            [
                'question' => '手数料はかかりますか？',
                'answer' => 'プロジェクト作成者には5%の手数料がかかります。支援者には手数料はかかりません。'
            ],
            [
                'question' => 'プロジェクトの審査はありますか？',
                'answer' => 'すべてのプロジェクトは、利用規約に準拠しているかどうかを確認する審査を行います。審査は通常1-3営業日で完了します。'
            ],
            [
                'question' => 'アカウントを削除できますか？',
                'answer' => '設定ページからアカウントを削除できます。ただし、進行中のプロジェクトがある場合は、プロジェクト完了後に削除することをお勧めします。'
            ],
            [
                'question' => 'お問い合わせはどこにすればよいですか？',
                'answer' => 'お問い合わせは、フッターの「お問い合わせ」リンクから、またはサポートページからお気軽にご連絡ください。'
            ]
        ];

        return view('pages.faq', compact('faqs'));
    }

    /**
     * Display the categories page
     */
    public function categories()
    {
        $categories = ProjectCategory::withCount('projects')->get();
        
        return view('pages.categories', compact('categories'));
    }

    /**
     * Display the guide page for project creators
     */
    public function guide()
    {
        return view('pages.guide');
    }

    /**
     * Display the contact page
     */
    public function contact()
    {
        return view('pages.contact');
    }

    /**
     * Handle contact form submission
     */
    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Send email to admin
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            // Laravelのメールビューには $message という予約変数があるため名称を変更
            'body' => $request->message,
        ];

        try {
            Mail::send('emails.contact', $data, function ($m) use ($data) {
                $m->to('uknight.sc@hachiouji-uknight.com')
                  ->subject('【Uknight Cloud】お問い合わせ: ' . $data['subject'])
                  ->replyTo($data['email'], $data['name']);
            });
            
            return redirect()->route('contact')->with('success', 'お問い合わせありがとうございます。内容を確認の上、ご連絡いたします。');
        } catch (\Exception $e) {
            return redirect()->route('contact')->with('error', '送信に失敗しました。しばらく時間をおいて再度お試しください。');
        }
    }

    /**
     * Display the terms of service page
     */
    public function terms()
    {
        return view('pages.terms');
    }

    /**
     * Display the privacy policy page
     */
    public function privacy()
    {
        return view('pages.privacy');
    }

    /**
     * Display the commercial transactions law page
     */
    public function commercialLaw()
    {
        return view('pages.commercial-law');
    }

    /**
     * Display the company overview page
     */
    public function company()
    {
        return view('pages.company');
    }
}