<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function getValidatorInstance()
    {
        // プルダウンで選択された値を取得
        $year = $this->input('old_year');   // 年
        $month = $this->input('old_month');  // 月
        $day = $this->input('old_day');      // 日

        // 年、月、日を組み合わせて日付を作成 (例: 2020-1-20)
        $datetime_validation = $year . '-' . $month . '-' . $day;

        // 作成した日付をrulesに追加
        $this->merge([
            'datetime_validation' => $datetime_validation,  // 完成した日付
            'old_year' => $year,
            'old_month' => $month,
            'old_day' => $day,
        ]);

        // 親クラスのgetValidatorInstanceを呼び出す
        return parent::getValidatorInstance();
    }


    public function authorize()
    {
        if ($this->path() == 'register/post') {
            return true;
        } else {
            return false;
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //新規登録のバリデーション
        return [
            'over_name' => 'required|string|max:10',
            'under_name' => 'required|string|max:10',
            'over_name_kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30|',
            'under_name_kana' => 'required|string|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u|max:30|',
            'mail_address' => 'required|email|unique:users,mail_address|max:100',
            'sex' => 'required|in:1,2,3',
            'datetime_validation' => 'required|date|before:tomorrow',// 正しい日付かどうかをチェック
            'old_year' => 'required|date',
            'old_month' => 'required|date',
            'old_day' => 'required|date',
            'role' => 'required|in:1,2,3,4',
            'password' => 'required|max:30|min:8|confirmed',
        ];
    }

    //登録画面のバリデーションメッセージ
    public function messages()
    {
        return [
            'over_name.required' => '入力必須項目です。',
            'over_name.max' => '最大文字数は10文字です。',
            'over_name.string' => '文字列で入力してください。',
            'under_name.required' => '入力必須項目です。',
            'under_name.max' => '最大文字数は10文字です。',
            'under_name.string' => '文字列で入力してください。',
            'over_name_kana.required' => '入力必須項目です。',
            'over_name_kana.max' => '最大文字数は30文字です。',
            'over_name_kana.string' => '文字列で入力してください。',
            'over_name_kana.regex' => 'カタカナで入力してください。',
            'under_name_kana.required' => '入力必須項目です。',
            'under_name_kana.max' => '最大文字数は30文字です。',
            'under_name_kana.string' => '文字列で入力してください。',
            'under_name_kana.regex' => 'カタカナで入力してください。',
            'mail_address.required' => '入力必須項目です。',
            'mail_address.email' => 'メールアドレスの形式で入力してください。',
            'mail_address.unique' => '登録済みのアドレスは使用できません。',
            'mail_address.max' => '最大文字数は100文字です。',
            'sex.required' => '入力必須項目です。',
            'sex.in' => '男性、女性、その他以外は無効です。',
            'datetime_validation.date' => '正しい日付で入力してください。',
            // 'old_year.required' => '入力必須項目です。',
            // 'old_year.after_or_equal' => '2000年1月1日以降を指定してください。',
            // 'old_year.before_or_equal' => '今日までを指定してください。',
            // 'old_month.required' => '入力必須項目です。',
            // 'old_month.date' => '正しい日付で入力してください。',
            // 'old_month.after_or_equal' => '2000年1月1日以降を指定してください。',
            // 'old_month.before_or_equal' => '今日までを指定してください。',
            // 'old_day.required' => '入力必須項目です。',
            // 'old_day.date' => '正しい日付で入力してください。',
            // 'old_day.after_or_equal' => '2000年1月1日以降を指定してください。',
            // 'old_day.before_or_equal' => '今日までを指定してください。',
            'role.required' => '入力必須項目です。',
            'role.in' => '講師(国語)、講師(数学)、教師(英語)、生徒以外無効です。',
            'password.required' => '入力必須項目です。',
            'password.max' => '最大文字数は30文字です。',
            'password.min' => '最小文字数は8文字です。',
            'password.confirmed' => 'パスワードを一致させてください。',
        ];
    }

}
