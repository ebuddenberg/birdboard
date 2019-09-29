    <div class="card flex flex-col" style="height: 200px">
        <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue-300 pl-4">
            <a href="{{ $project->path() }}">{{ $project->title }}</a>
        </h3>

        <div class="text-gray-600 mb-4 flex-1">{{ str_limit($project->description, 145) }}</div>

        <footer>
            <form action="{{ $project->path() }}" method="POST" class="text-right">
                @method('DELETE')
                @csrf
                <button type="submit" class="text-xs">Delete</button>
            </form>
        </footer>
    </div>
