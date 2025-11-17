@foreach($courses as $course)
    <div class="group bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-lg transition-all duration-300 cursor-pointer flex flex-col h-full">
        <a href="{{ route('public.course.show', $course) }}" class="block h-full flex flex-col">
            
            <div class="relative h-40 bg-gray-200 rounded-t-lg overflow-hidden">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($course->title) }}&background=random&size=400" alt="{{ $course->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute top-0 right-0 bg-black/50 text-white text-xs font-bold px-2 py-1 m-2 rounded">
                    {{ $course->category->name }}
                </div>
            </div>

            <div class="p-4 flex flex-col flex-grow">
                <h4 class="text-base font-bold text-gray-900 line-clamp-2 leading-snug group-hover:text-blue-700 transition-colors">
                    {{ $course->title }}
                </h4>
                <p class="text-xs text-gray-500 mt-1 truncate">{{ $course->teacher->name }}</p>
                
                <div class="flex items-center mt-2 mb-1">
                    <span class="text-sm font-bold text-orange-800 mr-1">4.8</span>
                    <div class="flex text-orange-400 text-xs">★★★★★</div>
                    <span class="text-xs text-gray-400 ml-1">({{ $course->students_count * 12 }})</span>
                </div>

                <div class="mt-auto pt-2 flex items-center justify-between">
                    <div class="flex flex-col">
                        <span class="text-lg font-bold text-gray-900">Gratis</span>
                        <span class="text-xs text-gray-500 line-through">Rp 149.000</span>
                    </div>
                    @if($course->students_count > 5)
                        <span class="bg-yellow-100 text-yellow-800 text-[10px] font-bold px-2 py-1 rounded-sm uppercase">Terlaris</span>
                    @endif
                </div>
            </div>
        </a>
    </div>
@endforeach

@if($courses->isEmpty())
    <div class="col-span-full text-center py-10 text-gray-500">
        Belum ada kursus untuk kategori ini.
    </div>
@endif