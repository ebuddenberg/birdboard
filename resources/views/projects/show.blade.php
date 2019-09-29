@extends ('layouts.app')

@section('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-500">
                <a href="/projects" class="text-gray-500">My Projects</a>  / {{ $project->title }}
            </p>
            <div class="flex items-center">
                @foreach ($project->members as $member)
                    <img src="https://gravatar.com/avatar/{{ md5($member->email) }}s=60" alt="{{ $member->name }}'s avatar'" class="rounded-full w-8 mr-2">
                @endforeach

                <a href="{{ $project->path() . '/edit' }}" class="button ml-6">Edit Project</a>
            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-gray-500 mb-3">Tasks</h2>

                    {{-- tasks --}}
                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form action="{{ $task->path() }}" method="POST">
                                @method('PATCH')
                                @csrf

                                <div class="flex">
                                    <input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-gray-500' : '' }}">
                                    <input name="completed" type="checkbox" onChange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                </div>
                            </form>
                        </div>
                    @endforeach

                    <div class="card mb-3">
                        <form action="{{ $project->path() . '/tasks' }}" method="POST">
                            @csrf

                            <input name="body" placeholder="Add a new task" class="w-full">
                        </form>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg text-gray-500 mb-3">General Notes</h2>

                    {{-- general notes --}}
                    <form action="{{ $project->path() }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <textarea
                        name="notes"
                            class="card w-full mb-4"
                            style="min-height: 200px;"
                            placeholder="Anything special that you want to make a note of?"
                        >{{ $project->notes }}</textarea>

                        <button class="button">Save</button>
                    </form>

                    @include ('errors')
                </div>
            </div>

            <div class="lg:w-1/4 px-3 lg:py-10">
                @include('projects.card')
                @include('projects.activity.card')

                @can('manage', $project)
                    @incllude('projects.invite')
                @endcan
            </div>
        </div>
    </main>

@endsection
