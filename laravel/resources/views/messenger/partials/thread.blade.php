<?php

$class = $thread->isUnread(Auth::id()) ? 'alert-info' : ''; ?>

<div class="messages-panel{{ $class }}">

    <p class="message">{{ $thread->latestMessage->body }}
    </p>
</div>
