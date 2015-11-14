<?php

/**
 * MailQueueCommand class file.
 *
 * @author Widarto Pangestu
 * @date 26-Nov-2014
 */

/**
 * Sends out emails based on the retrieved EmailQueue objects. 
 */

class MailQueueCommand extends CConsoleCommand {

    public function run($args) {
        $criteria = new CDbCriteria(array(
            'condition' => 'success=:success AND attempts < max_attempts',
            'params' => array(
                ':success' => 0,
            ),
        ));

        $queueList = EmailQueue::model()->findAll($criteria);
        echo "Start process send email. \r\n";
        if (count($queueList)) {

            /* @var $queueItem EmailQueue */
            foreach ($queueList as $queueItem) {
                echo "Sending email to " . $queueItem->to_email . " ..... \r\n";
                if (Yii::app()->params['mail_type'] == 'smtp') {
                    Yii::import('ext.yii-mail.YiiMailMessage');
                    $message = new YiiMailMessage();
                    $message->setTo($queueItem->to_email);
                    $message->setFrom(array($queueItem->from_email => $queueItem->from_name));
                    $message->setSubject($queueItem->subject);
                    $message->setBody($queueItem->message, 'text/html');

                    if ($this->sendEmail($message)) {
                        $queueItem->attempts = $queueItem->attempts + 1;
                        $queueItem->success = 1;
                        $queueItem->last_attempt = new CDbExpression('NOW()');
                        $queueItem->date_sent = new CDbExpression('NOW()');
                        $queueItem->save();
                        echo "Sending email to " . $queueItem->to_email . " success. Date send : " .  date('d-m-Y h:i:s') . "\r\n";
                    } else {
                        $queueItem->attempts = $queueItem->attempts + 1;
                        $queueItem->last_attempt = new CDbExpression('NOW()');
                        $queueItem->save();
                        echo "Sending email to " . $queueItem->to_email . " failed. Last attempt : " . $queueItem->attempts . "\r\n";
                    }
                } else {
                    $from_email = $queueItem->from_email;
                    $to_email = $queueItem->to_email;
                    $subject = $queueItem->subject;
                    $message = $queueItem->message;
                    $headers = "MIME-Version: 1.0\r\nFrom: $from_email\r\nReply-To: $from_email\r\nContent-Type: text/html; charset=utf-8";
                    $message = wordwrap($message, 70);
                    $message = str_replace("\n.", "\n..", $message);

                    if (mail($to_email, '=?UTF-8?B?' . base64_encode($subject) . '?=', $message, $headers)) {
                        $queueItem->attempts = $queueItem->attempts + 1;
                        $queueItem->success = 1;
                        $queueItem->last_attempt = new CDbExpression('NOW()');
                        $queueItem->date_sent = new CDbExpression('NOW()');
                        $queueItem->save();
                        echo "Sending email to " . $queueItem->to_email . " success. Date send : " . date('d-m-Y h:i:s') . "\r\n";
                    } else {
                        $queueItem->attempts = $queueItem->attempts + 1;
                        $queueItem->last_attempt = new CDbExpression('NOW()');
                        $queueItem->save();
                        echo "Sending email to " . $queueItem->to_email . " failed. Last attempt : " . $queueItem->attempts . "\r\n";
                    }
                }
            }
        } else {
            echo "There is no email to be processed. \r\n";
        }
        echo "Send email finish. \r\n";
    }

    /**
     * Sends an email to the user.
     * This methods expects a complete message that includes to, from, subject, and body
     *
     * @param YiiMailMessage $message the message to be sent to the user
     * @return boolean returns true if the message was sent successfully or false if unsuccessful
     */
    private function sendEmail(YiiMailMessage $message) {
        $sendStatus = false;

        if (Yii::app()->mail->send($message) > 0)
            $sendStatus = true;

        return $sendStatus;
    }

}
