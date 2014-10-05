<?php

class MailController extends Controller {

	public function formr($data)
	{
		if (!sizeof($data)) {
			App::abort('No data found for send a mail', 500);
		}

		Mail::send('emails.formr.formr', $data, function($message)
		{
		    $message->to('foo@example.com');
		});

		return true;
	}

}