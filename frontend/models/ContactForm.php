<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $company_name;
    public $name;
    public $email;
    public $tel;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['company_name', 'name', 'email', 'tel', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {

        $company_name = $this->company_name;
        $contact_person = $this->name;
        $tel = $this->tel;
        $full_body = '<html><body>';
        $full_body .= '<b>' . Yii::t('common', 'company_name') . ':</b> ' . $company_name . '<br>' .
            '<b>' . Yii::t('common', 'contact_person') . ':</b> ' . $contact_person . '<br>' .
            '<b>' . Yii::t('common', 'phone_number') . ':</b> ' . $tel . '<br><hr><p>' . $this->body . '</p>';
        $full_body .= '</body></html>';

        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setHtmlBody($full_body)
            ->send();
    }
}
