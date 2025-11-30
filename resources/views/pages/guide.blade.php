@extends('layouts.app')

@section('content')
<section class="py-5" style="background: var(--bg-secondary);">
    <div class="container" style="max-width: 960px;">
        <h1 class="mb-3" style="color: var(--primary-color); font-weight: 700;">プロジェクト作成ガイド</h1>
        <p class="text-muted mb-4">Uknight Cloud でプロジェクトを立ち上げるための手順をまとめました。まずは申請から始め、承認後に各種設定を行います。</p>

        <ol class="list-group list-group-numbered mb-5" style="box-shadow: var(--shadow-sm);">
            <li class="list-group-item py-4">
                <h5 class="mb-2">申請を送る</h5>
                <p class="mb-2">ダッシュボードにログイン後、「プロジェクト作成申請」から申請理由を入力して送信してください。審査状況は管理側で確認し、結果はメールでお知らせします。</p>
                <a class="btn btn-sm btn-outline-success" href="{{ route('project-creation-requests.create') }}">申請ページへ</a>
            </li>
            <li class="list-group-item py-4">
                <h5 class="mb-2">承認を待つ</h5>
                <p class="mb-0">通常 1〜3 営業日で審査します。承認されると、あなたのアカウントに「プロジェクト作成権限」が付与されます。</p>
            </li>
            <li class="list-group-item py-4">
                <h5 class="mb-2">口座（振込先）を登録</h5>
                <p class="mb-0">支援金の入金に必要です。ダッシュボードの「プロフィール設定」から、受取口座情報を正確に登録してください。</p>
            </li>
            <li class="list-group-item py-4">
                <h5 class="mb-2">プロジェクトを作成</h5>
                <p class="mb-0">「プロジェクト管理」から新規作成します。タイトル、概要、目標金額、期間、リワード（商品）などを設定します。画像や動画の追加で訴求力が高まります。</p>
            </li>
            <li class="list-group-item py-4">
                <h5 class="mb-2">公開申請 → 公開</h5>
                <p class="mb-0">内容を確認し、公開申請してください。問題がなければ公開され、支援の受付が開始されます。</p>
            </li>
        </ol>

        <div class="bg-white p-4 rounded-3" style="box-shadow: var(--shadow-sm);">
            <h5 class="mb-3">よくある質問</h5>
            <ul class="mb-0">
                <li class="mb-2">審査は通常 1〜3 営業日です。急ぎの場合はお問い合わせください。</li>
                <li class="mb-2">口座名義は本人確認書類と一致している必要があります。</li>
                <li class="mb-2">公開後の主要項目の変更には再審査が必要になる場合があります。</li>
            </ul>
        </div>
    </div>
</section>
@endsection





