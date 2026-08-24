<div class="pt-3 border-t border-gray-100" x-data="{ showApplicants: false }">

    <button @click="showApplicants = !showApplicants" type="button"
        class="w-full flex items-center justify-between py-1.5 px-3 bg-gray-50 hover:bg-sky-50/60 rounded-xl transition-colors text-xs font-semibold text-gray-700 hover:text-sky-600">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-users text-sky-500"></i>

            <span>Applicants</span>

            <span
                class="px-2 py-0.5 text-[11px] font-bold rounded-full bg-white border border-gray-200 text-gray-700 shadow-2xs">
                {{ $game->applicants->count() }}
            </span>
        </div>

        <i class="fa-solid text-gray-400 transition-transform duration-200"
            :class="showApplicants ? 'fa-chevron-up text-sky-500' : 'fa-chevron-down'"></i>
    </button>

    <div x-show="showApplicants" x-cloak class="mt-3 space-y-2.5">

        @forelse($game->applicants as $applicant)
            <div class="p-3.5 bg-gray-50/70 border border-gray-100 rounded-xl space-y-2.5">

                <!-- Applicant Header & Actions -->
                <div class="flex items-center justify-between gap-3 flex-wrap">

                    <div class="flex items-center gap-2.5">

                        <!-- Initials Avatar -->
                        <div
                            class="w-8 h-8 rounded-xl bg-sky-100 text-sky-600 font-bold text-xs flex items-center justify-center shadow-2xs">
                            {{ strtoupper(substr($applicant->full_name, 0, 1)) }}
                        </div>

                        <div>
                            <h5 class="text-xs font-bold text-gray-900">
                                {{ $applicant->full_name }}
                            </h5>

                            <p class="text-[10px] text-gray-400">
                                Applied {{ $applicant->created_at?->diffForHumans() }}
                            </p>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-1.5">

                        @if ($applicant->resume_path)
                            <a href="{{ asset('storage/' . $applicant->resume_path) }}" target="_blank"
                                class="px-2.5 py-1 bg-white hover:bg-gray-100 text-gray-700 border border-gray-200 rounded-lg text-[11px] font-medium transition-colors flex items-center gap-1">
                                <i class="fa-solid fa-paperclip text-sky-500"></i>
                                <span>Resume</span>
                            </a>
                        @endif

                        <a href="mailto:{{ $applicant->contact_email }}?subject=Game%20Application:%20{{ urlencode($game->title) }}"
                            class="px-2.5 py-1 bg-sky-500 hover:bg-sky-600 text-white rounded-lg text-[11px] font-semibold transition-colors flex items-center gap-1 shadow-2xs">
                            <i class="fa-regular fa-envelope"></i>
                            <span>Contact</span>
                        </a>

                        <form method="POST" action="{{ route('applicant.destroy', $applicant->id) }}"
                            onsubmit="return confirm('Are you sure you want to delete this applicant?')"
                            class="inline flex items-center">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="p-1.5 text-rose-500 hover:text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200/60 rounded-lg transition-colors flex items-center justify-center cursor-pointer"
                                title="Delete Applicant">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </form>

                    </div>

                </div>

                <!-- Contact Details -->
                <div
                    class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-2 border-t border-gray-200/50 text-[11px] text-gray-600">

                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-gray-400 w-3.5"></i>
                        <span>{{ $applicant->contact_email }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-gray-400 w-3.5"></i>

                        <a href="tel:{{ $applicant->contact_phone }}" class="hover:underline hover:text-sky-600">
                            {{ $applicant->contact_phone ?? 'N/A' }}
                        </a>
                    </div>

                    @if ($applicant->location)
                        <div class="flex items-center gap-2 sm:col-span-2">
                            <i class="fa-solid fa-location-dot text-gray-400 w-3.5"></i>
                            <span>{{ $applicant->location }}</span>
                        </div>
                    @endif

                </div>

                <!-- Optional Message -->
                @if ($applicant->message)
                    <div
                        class="p-2.5 bg-white border border-gray-100 rounded-lg text-[11px] text-gray-600 italic leading-relaxed">
                        "{{ $applicant->message }}"
                    </div>
                @endif

            </div>

        @empty

            <div
                class="p-4 bg-gray-50/50 border border-dashed border-gray-200 rounded-xl text-center text-gray-400 text-xs">
                <i class="fa-regular fa-folder-open mb-1 text-sm block text-gray-300"></i>

                No applicants for this game yet.
            </div>
        @endforelse

    </div>

</div>
