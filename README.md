# Dhiraagu Bulk SMS Package

A Laravel package for integrating with Dhiraagu Bulk SMS API.

## Installation

1.  **Add the Repository to Composer**

        composer require hashes02/dhiraagu-bulk-sms


3.  **Publish the Configuration**

        php artisan vendor:publish --provider="Hashes02\\DhiraaguBulkSms\\SmsServiceProvider"

4.  **Add Environment Variables**
    Add the following to your `.env` file:

        SMS_SENDER_ID=yourSenderId
        SMS_CLIENT_ID=yourClientId
        SMS_AUTHORIZATION=yourAuthorizationBase64

### Create Controller and Routes

1.  **Create `SmsController`**

        <?php

            namespace App\Http\Controllers;

            use Illuminate\Http\Request;

            class SmsController extends Controller
            {
                public function sendSms(Request $request)
                {
                    $message = $request->input('message');
                    $recipient = $request->input('recipient');

                    $smsSender = app('sms.sender');
                    $response = $smsSender->sendSms($message, $recipient);

                    return response()->json(['message' => 'SMS sent', 'response' => $response]);
                }
            }

2.  **Define Routes**

        use App\Http\Controllers\SmsController;

        Route::post('/send-sms', [SmsController::class, 'sendSms']);

3.  **Create the Form**

   In your view:

        <form method="POST" action="/send-sms">
        @csrf
            <input type="text" name="recipient" placeholder="Recipient number">
            <textarea name="message" placeholder="Message"></textarea>
            <button type="submit">Send SMS</button>
        </form>

## Usage 

        use DhiraaguBulkSms\DhiraaguBulkSms;

        $sms = new DhiraaguBulkSms();
        $sms->send('recipient_number', 'Your message here');

