@extends('dashboard')

@section('body')
    <div class="container p-5">
        <h1 class="p-4">Feedback List</h1>
            @include('alerts')
            @include('feedback.filter')
        <table class="table p-5">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Vote Count</th>
                    <th>Submitted By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td><a href="{{ route('feedback.show', $feedback) }}">{{ $feedback->title }}</a></td>
                        <td>{{ $feedback->category }}</td>
                        <td>{{ $feedback->votes()->count() }}</td>
                        <td>{{ $feedback->user->name }}</td>
                        <td class="d-flex justify-content-between align-items-center p-3">
                            {{-- IT NOT BEST PRACTICE TO USE SVG BUT IM ANABLE TO USE ICON SO IM USING THIS --}}
                            <form method="post" action="{{ route('votes.update', $feedback->id) }}" class="{{ isset($userVotes[$feedback->id]) && $userVotes[$feedback->id] === 1 ? 'opacity-25' : '' }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="vote" value="1"> <!-- Upvote -->
                                <button type="submit" class="btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Up Vote"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path
                                            d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z" />
                                    </svg>
                                </button>
                            </form>

                            {{-- DOWN VOTE  --}}
                            <form method="post" action="{{ route('votes.update', $feedback->id) }}" class="{{ isset($userVotes[$feedback->id]) && $userVotes[$feedback->id] === -1 ? 'opacity-25' : '' }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="vote" value="-1"> <!-- Downvote -->
                                <button type="submit" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 384 512"
                                        data-toggle="tooltip" data-placement="top"
                                        title="Down Vote"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <path
                                            d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z" />
                                    </svg>
                                </button>
                            </form>

                            {{-- COMMENT  --}}
                            <a href="{{ route('feedback.show', $feedback->id) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Comment"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                    <path
                                        d="M123.6 391.3c12.9-9.4 29.6-11.8 44.6-6.4c26.5 9.6 56.2 15.1 87.8 15.1c124.7 0 208-80.5 208-160s-83.3-160-208-160S48 160.5 48 240c0 32 12.4 62.8 35.7 89.2c8.6 9.7 12.8 22.5 11.8 35.5c-1.4 18.1-5.7 34.7-11.3 49.4c17-7.9 31.1-16.7 39.4-22.7zM21.2 431.9c1.8-2.7 3.5-5.4 5.1-8.1c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208s-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6c-15.1 6.6-32.3 12.6-50.1 16.1c-.8 .2-1.6 .3-2.4 .5c-4.4 .8-8.7 1.5-13.2 1.9c-.2 0-.5 .1-.7 .1c-5.1 .5-10.2 .8-15.3 .8c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c4.1-4.2 7.8-8.7 11.3-13.5c1.7-2.3 3.3-4.6 4.8-6.9c.1-.2 .2-.3 .3-.5z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $feedbacks->links() }}
    </div>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
