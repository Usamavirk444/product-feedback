@extends('dashboard')

@section('body')
    <section style="background-color: #eee;">
        @include('alerts')
        <div class="container my-5 py-5">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-start align-items-center">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar"
                                    width="60" height="60" />
                                <div>
                                    <h6 class="fw-bold text-primary mb-1">{{ $feedback->user->name }}</h6>
                                    <p class="text-muted small mb-0">
                                        Shared publicly - {{ $feedback->created_at->format('d-m-Y') }}
                                    </p>
                                </div>
                            </div>
                                @forelse ( $feedback->attachments as $image )
                                    <div class="gallery mt-5">
                                        <a target="_blank" href="img_5terre.jpg">
                                        <img src="{{ asset('storage/'. $image->filename) }}" alt="" width="600" height="400">
                                        </a>
                                    </div>
                                @empty

                                @endforelse
                            <h1 class="mt-3"> <strong>TITLE: </strong> {{ $feedback->title }}</h1>
                            <p class="mt-3 mb-4 pb-2">
                                <Strong> DESCRIPITION: </Strong>
                                {{ $feedback->description }}
                            </p>

                            <div class="small d-flex justify-content-start">

                                <a href="#!" class="d-flex align-items-center me-3">
                                    <i class="far fa-comment-dots me-2"></i>
                                    <p class="mb-0">Comment</p>
                                </a>
                            </div>
                        </div>
                        @foreach ($feedback->comments as $comment)
                        <div class="comment p-2 m-3" style="border: 1px solid #ccc; border-radius: 5px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $comment->user->name }}</strong> -
                                    {{ $comment->created_at->diffForHumans() }}
                                </div>
                                <!-- You can add a delete button here if needed -->
                            </div>
                            <p class="mt-2" style="white-space: pre-line;">{!! $comment->content !!}</p>
                        </div>
                    @endforeach
                        <form method="POST" action="{{ route('comments.store',$id) }}">
                            @csrf
                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                <div class="d-flex flex-start w-100">
                                    <div class="form-outline w-100">
                                        <textarea class="form-control" name="content" id="comment-content" rows="4" style="background: #fff;"></textarea>
                                        <label class="form-label" for="textAreaExample">Message</label>
                                    </div>
                                </div>
                                <div class="float-end mt-2 pt-1">
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Post comment</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.tiny.cloud/1/api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#comment-content',
            plugins: 'link lists',
            toolbar: 'bold italic underline strikethrough | bullist numlist | link',
        });
    </script>
@endsection
