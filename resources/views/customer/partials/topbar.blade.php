<div class="topbar-icons">

    {{-- NOTIFIKASI --}}
    <div class="dropdown">
        <a href="#"
           class="topbar-icon"
           data-bs-toggle="dropdown"
           aria-expanded="false"
           id="custNotifDropdown">
            <i class="bi bi-bell"></i>

            @if(auth()->user()->unreadNotifications->count() > 0)
                <span class="notification-badge">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            @endif
        </a>

        <div class="dropdown-menu dropdown-menu-end notif-dropdown"
             id="custNotifMenu">

            <div class="notif-header">
                <span class="notif-title">Notifikasi</span>

                @if(auth()->user()->unreadNotifications->count() > 0)
                    <a href="#"
                       class="notif-mark-read"
                       onclick="event.preventDefault(); markAllNotifications();">
                        Tandai semua dibaca
                    </a>
                @endif
            </div>

            <div class="notif-list">
                @forelse(auth()->user()->notifications->take(5) as $notif)

                    <a href="{{ route('notifications.show', $notif->id) }}"
                       class="notif-item {{ $notif->is_read ? 'read' : 'unread' }}"
                       data-id="{{ $notif->id }}"
                       onclick="handleNotifClick(this, event)">

                        <div class="notif-icon-wrap"
                             style="background: {{ $notif->type === 'success' ? '#ecfdf5' : ($notif->type === 'warning' ? '#fffbeb' : ($notif->type === 'danger' ? '#fff1f2' : 'var(--accent-light)')) }};">

                            <i class="bi {{ $notif->icon ?: 'bi-bell' }}"
                               style="color: {{ $notif->type === 'success' ? '#16a34a' : ($notif->type === 'warning' ? '#ca8a04' : ($notif->type === 'danger' ? '#dc2626' : 'var(--accent)')) }};"></i>
                        </div>

                        <div class="notif-content">
                            <div class="notif-text">
                                {{ $notif->title }}
                            </div>

                            <div class="notif-time">
                                {{ $notif->created_at->diffForHumans() }}
                            </div>
                        </div>

                        @if(!$notif->is_read)
                            <div class="notif-dot"></div>
                        @endif

                    </a>

                @empty

                    <div class="notif-empty">
                        <i class="bi bi-bell-slash"></i>
                        <span>Tidak ada notifikasi</span>
                    </div>

                @endforelse
            </div>

            <a href="{{ route('notifications.index') }}"
               class="notif-footer">
                Lihat semua notifikasi
            </a>
        </div>
    </div>


    {{-- PESAN --}}
    <div class="dropdown">
        <a href="#"
           class="topbar-icon"
           data-bs-toggle="dropdown"
           aria-expanded="false"
           id="custMsgDropdown">

            <i class="bi bi-chat-dots"></i>

            @if(auth()->user()->unreadMessages->count() > 0)
                <span class="notification-badge">
                    {{ auth()->user()->unreadMessages->count() }}
                </span>
            @endif
        </a>

        <div class="dropdown-menu dropdown-menu-end notif-dropdown"
             id="custMsgMenu">

            <div class="notif-header">
                <span class="notif-title">Pesan</span>
            </div>

            <div class="notif-list">

                @forelse(auth()->user()->receivedMessages()->latest()->take(5)->get() as $msg)

                    <a href="{{ route('messages.show', $msg->id) }}"
                       class="notif-item {{ $msg->read_at ? 'read' : 'unread' }}">

                        <div class="notif-icon-wrap"
                             style="background: {{ $msg->read_at ? '#f8fafc' : 'var(--accent-light)' }};">

                            <i class="bi bi-envelope"
                               style="color: {{ $msg->read_at ? '#94a3b8' : 'var(--accent)' }};"></i>
                        </div>

                        <div class="notif-content">
                            <div class="notif-text">
                                {{ $msg->subject }}
                            </div>

                            <div class="notif-time">
                                {{ $msg->created_at->diffForHumans() }}
                            </div>
                        </div>

                        @if(!$msg->read_at)
                            <div class="notif-dot"></div>
                        @endif

                    </a>

                @empty

                    <div class="notif-empty">
                        <i class="bi bi-inbox"></i>
                        <span>Tidak ada pesan</span>
                    </div>

                @endforelse

            </div>

            <a href="{{ route('messages.index') }}"
               class="notif-footer">
                Lihat semua pesan
            </a>

        </div>
    </div>

</div>


<script>
function handleNotifClick(element, event) {
    const notifId = element.dataset.id;

    fetch('/notifications/' + notifId + '/read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    });
}

function markAllNotifications() {
    fetch('{{ route('notifications.markAllRead') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {

            document.querySelectorAll('.notif-item.unread').forEach(item => {
                item.classList.remove('unread');
                item.classList.add('read');

                const dot = item.querySelector('.notif-dot');

                if (dot) {
                    dot.remove();
                }
            });

            document.querySelectorAll('#custNotifDropdown .notification-badge')
                .forEach(badge => badge.remove());

            const markReadLink = document.querySelector('.notif-mark-read');

            if (markReadLink) {
                markReadLink.remove();
            }
        }
    });
}
</script>