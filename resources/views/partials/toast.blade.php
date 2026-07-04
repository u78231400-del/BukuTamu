<style>
    .toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
    .toast-item { display: flex; align-items: center; gap: 12px; padding: 14px 20px; border-radius: 10px; color: #fff; min-width: 300px; max-width: 420px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); transform: translateX(120%); transition: transform 0.4s cubic-bezier(0.68,-0.55,0.27,1.55); font-family: 'Poppins', sans-serif; }
    .toast-item.show { transform: translateX(0); }
    .toast-item.hide { transform: translateX(120%); opacity: 0; transition: transform 0.3s ease, opacity 0.3s ease; }
    .toast-icon { font-size: 22px; flex-shrink: 0; }
    .toast-msg { font-size: 14px; flex: 1; line-height: 1.4; }
    .toast-close { background: none; border: none; color: #fff; font-size: 18px; cursor: pointer; opacity: 0.7; padding: 0; line-height: 1; }
    .toast-close:hover { opacity: 1; }
    .toast-progress { position: absolute; bottom: 0; left: 0; height: 3px; border-radius: 0 0 10px 10px; animation: toastProgress 3s linear forwards; }
    .toast-success { background: linear-gradient(135deg, #1cc88a, #13855c); }
    .toast-success .toast-progress { background: rgba(255,255,255,0.4); }
    .toast-warning { background: linear-gradient(135deg, #f6c23e, #dda20a); }
    .toast-warning .toast-progress { background: rgba(255,255,255,0.4); }
    .toast-error { background: linear-gradient(135deg, #e74a3b, #c0392b); }
    .toast-error .toast-progress { background: rgba(255,255,255,0.4); }
    @keyframes toastProgress { from { width: 100%; } to { width: 0%; } }
</style>

<div class="toast-container" id="toastContainer"></div>

<script>
function showToast(message, type = 'success') {
    const container = document.getElementById('toastContainer');
    const icons = { success: '✅', warning: '⚠️', error: '❌' };

    const toast = document.createElement('div');
    toast.className = `toast-item toast-${type}`;
    toast.innerHTML = `
        <span class="toast-icon">${icons[type] || icons.success}</span>
        <span class="toast-msg">${message}</span>
        <button class="toast-close" onclick="this.parentElement.remove()">&times;</button>
        <div class="toast-progress"></div>
    `;

    container.appendChild(toast);
    requestAnimationFrame(() => toast.classList.add('show'));

    setTimeout(() => {
        toast.classList.remove('show');
        toast.classList.add('hide');
        toast.addEventListener('transitionend', () => toast.remove());
    }, 3000);
}

@php
    $toastType = null;
    $toastMessage = null;
    if(session('error')) { $toastType = 'error'; $toastMessage = session('error'); }
    elseif(session('warning')) { $toastType = 'warning'; $toastMessage = session('warning'); }
    elseif(session('success')) { $toastType = 'success'; $toastMessage = session('success'); }
@endphp
@if($toastMessage)
    showToast('{{ $toastMessage }}', '{{ $toastType }}');
@endif
</script>
