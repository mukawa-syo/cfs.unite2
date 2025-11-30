<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class ProfileUpdated extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $changedFields;

    /**
     * Create a new notification instance.
     */
    public function __construct(User $user, array $changedFields)
    {
        $this->user = $user;
        $this->changedFields = $changedFields;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $message = new MailMessage;
        $message->subject('プロフィール更新のお知らせ')
            ->greeting($this->user->name . ' 様')
            ->line('プロフィール情報が更新されました。')
            ->line('更新された項目:');

        foreach ($this->changedFields as $field => $value) {
            $fieldName = $this->getFieldName($field);
            // パスワードの場合は値を表示しない
            if ($field === 'password') {
                $message->line('- ' . $fieldName . ': 更新されました');
            } else {
                $message->line('- ' . $fieldName . ': ' . $value);
            }
        }

        $message->action('プロフィールを確認', route('dashboard.profile.edit'))
            ->line('このメールに心当たりがない場合は、直ちにご連絡ください。');

        return $message;
    }

    /**
     * フィールド名を日本語に変換
     */
    protected function getFieldName(string $field): string
    {
        return [
            'name' => '名前',
            'email' => 'メールアドレス',
            'postal_code' => '郵便番号',
            'prefecture' => '都道府県',
            'city' => '市区町村',
            'address' => '住所',
            'building_name' => '建物名',
            'phone_number' => '電話番号',
            'password' => 'パスワード',
        ][$field] ?? $field;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id' => $this->user->id,
            'changed_fields' => $this->changedFields,
        ];
    }
}
