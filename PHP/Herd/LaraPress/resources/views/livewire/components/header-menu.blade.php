<?php
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {}; ?>
<div class='hover:cursor-pointer m-0 p-0 '>
    <ul class="menu bg-base-200 lg:menu-horizontal rounded-box ml-2 mr-2">
        <li>
            <a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Home
                <span class="badge badge-sm">99+</span>
            </a>
        </li>
        <li>
            <a>

                Inbox
                <span class="badge badge-sm">250+</span>
            </a>
        </li>
        <li>
            <a>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Updates
                <span class="badge badge-sm badge-warning">NEW</span>
            </a>
        </li>
        <li>
            <a>
                Stats
                <span class="badge badge-xs badge-info"></span>
            </a>
        </li>
    </ul>
</div>
