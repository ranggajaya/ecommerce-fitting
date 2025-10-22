@props(['title' => ''])

<div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
    @if($title)
        <div class="px-6 py-4 bg-gradient-to-r from-indigo-50 to-purple-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
        </div>
    @endif
    <div class="p-6">
        {{ $slot }}
    </div>
</div>