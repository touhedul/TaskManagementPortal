<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContactDataTable;
use App\DataTables\FeedbackDataTable;
use App\Http\Controllers\Controller;
use App\Models\ContactFeedback;

class ContactFeedbackController extends Controller
{

    public function contacts(ContactDataTable $contactDataTable)
    {
        return $contactDataTable->render('admin.contact_feedbacks.contacts');
    }

    public function feedbacks(FeedbackDataTable $feedbackDataTable)
    {
        return $feedbackDataTable->render('admin.contact_feedbacks.feedbacks');
    }

    public function contactFeedbackDelete(ContactFeedback $contactFeedback)
    {
        $contactFeedback->delete();
    }

    public function show(ContactFeedback $contactFeedback)
    {
        return view('admin.contact_feedbacks.show',compact('contactFeedback'));
    }
}
