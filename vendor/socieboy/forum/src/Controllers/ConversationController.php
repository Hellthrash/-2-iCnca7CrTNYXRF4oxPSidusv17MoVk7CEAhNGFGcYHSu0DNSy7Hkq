<?php

namespace Socieboy\Forum\Controllers;

use App\Http\Controllers\Controller;
use App\Topic;
use Socieboy\Forum\Entities\Conversations\ConversationRepo;
use Socieboy\Forum\Jobs\Conversations\CreateConversationThread;
use Socieboy\Forum\Jobs\StartConversationJob;
use Socieboy\Forum\Requests\ConversationRequest;

class ConversationController extends Controller
{

    /**
     * @var ConversationRepo
     */
    protected $conversationRepo;

    /**
     * @param ConversationRepo $conversationRepo
     */
    function __construct(ConversationRepo $conversationRepo)
    {
        $this->middleware('auth', ['only' => ['store']]);

        $this->conversationRepo = $conversationRepo;

    }

    /**
     * Display a conversation and replies
     *
     * @param $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $conversation = $this->conversationRepo->findBySlug($slug);
        $topic = Topic::all();

        $replies = $conversation->replies()->orderBy('created_at', 'DESC')->paginate(4);

        return view('Forum::Conversations.show', compact('conversation', 'replies','topic'));
    }

    /**
     * Store the new conversation.
     *
     * @param ConversationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ConversationRequest $request)
    {

        $this->dispatchFrom('Socieboy\Forum\Jobs\Conversations\StartConversation', $request);

        return redirect()->route('forum');
    }

}
