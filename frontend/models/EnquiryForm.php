<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * EnquiryForm is the model behind the enquiry form.
 */
class EnquiryForm extends Model
{
    public $product_id;
    public $name;
    public $email;
    public $tel;
    public $address;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // address, name, email, subject and body are required
            [['product_id', 'name', 'email', 'tel', 'subject', 'body'], 'required'],
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

        $address = $this->address;
        $contact_person = $this->name;
        $tel = $this->tel;
        $full_body = '<html><body>';
        $full_body .=
            '<b>' . Yii::t('common', 'contact_person') . ':</b> ' . $contact_person . '<br>' .
            '<b>' . Yii::t('common', 'phone_number') . ':</b> ' . $tel . '<br>'.
            '<b>' . Yii::t('common', 'address') . ':</b> ' . $address . '<br><hr><p>' . $this->body . '</p>';
        $full_body .= '</body></html>';

        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setHtmlBody($full_body)
            ->send();
    }
}
