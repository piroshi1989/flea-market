<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>flea-market</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-md-10 col-sm-12 mx-auto">
            <div class="card py-4">
                <div class="card-body">
                    {{--Inform user after click resend verification email button is successful <--- this  --}}
                    @if (session('status') == 'verification-link-sent')
                        <div class="alert alert-success text-center">新しいメール認証リンクが送信されました！</div>
                    @endif
                    <div class="text-center mb-5">
                        {{--Instructions for new users <--- this  --}}
                        <h3>メールアドレスの確認</h3>
                        <p>このページにアクセスするには、メールアドレスの確認が必要です。</p>
                    </div>
                    <form method="POST" action="{{ route('verification.send') }}" class="text-center">
                        @csrf
                        <button type="submit" class="btn btn-primary">認証メールの送信</button>
                    </form>
                </div>
                {{--// Optional: Add this link to let user clear browser cache <--- this  --}}
            </div>
        </div>
    </div>
</div>