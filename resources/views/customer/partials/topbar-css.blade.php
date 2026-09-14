{{-- Reusable CSS for Customer Topbar --}}

<style>
    /* Topbar */
    .topbar {
        background: white;
        padding: 16px 32px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 50;
    }

    .topbar-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .menu-toggle {
        display: none;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: var(--text-dark);
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
    }

    .menu-toggle:hover {
        background: var(--bg-light);
    }

    .page-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .topbar-search {
        position: relative;
    }

    .topbar-search input {
        width: 280px;
        padding: 10px 16px 10px 40px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 0.9rem;
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg-light);
        transition: all 0.2s ease;
    }

    .topbar-search input:focus {
        outline: none;
        border-color: var(--accent);
        background: white;
    }

    .topbar-search i {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }

    /* User Dropdown */
    .user-dropdown {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 6px 12px 6px 6px;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .user-dropdown:hover {
        background: var(--bg-light);
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: var(--accent);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .user-info {
        text-align: left;
    }

    .user-name {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .user-role {
        font-size: 0.75rem;
        color: var(--text-light);
    }

    .user-dropdown i {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .dropdown-menu-custom {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        border: 1px solid #e5e7eb;
        min-width: 180px;
        padding: 8px;
        display: none;
        z-index: 100;
    }

    .dropdown-menu-custom.show {
        display: block;
    }

    .dropdown-item-custom {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 14px;
        color: var(--text-dark);
        text-decoration: none;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
        border: none;
        background: none;
        width: 100%;
        cursor: pointer;
    }

    .dropdown-item-custom:hover {
        background: var(--bg-light);
    }

    .dropdown-item-custom i {
        font-size: 1.1rem;
        color: var(--text-light);
    }

    .dropdown-item-custom.text-danger {
        color: #ef4444;
    }

    .dropdown-item-custom.text-danger:hover {
        background: rgba(239, 68, 68, 0.1);
    }

    .dropdown-item-custom.text-danger i {
        color: #ef4444;
    }

    /* Topbar Icons */
    .topbar-icons {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .topbar-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: var(--text-light);
        text-decoration: none;
        font-size: 1.2rem;
        transition: all 0.2s ease;
        position: relative;
    }

    .topbar-icon:hover {
        background: var(--bg-light);
        color: var(--text-dark);
    }

    .notification-badge {
        position: absolute;
        top: 4px;
        right: 4px;
        background: var(--accent);
        color: white;
        font-size: 10px;
        font-weight: 700;
        min-width: 16px;
        height: 16px;
        border-radius: 999px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 4px;
    }

    .notif-dropdown {
        width: 340px;
        padding: 0;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(0,0,0,.12);
        margin-top: 10px !important;
    }

    .notif-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 16px;
        border-bottom: 1px solid #e5e7eb;
    }

    .notif-title {
        font-size: 14px;
        font-weight: 700;
        color: var(--text-dark);
    }

    .notif-mark-read {
        font-size: 12px;
        color: var(--accent);
        text-decoration: none;
    }

    .notif-mark-read:hover {
        text-decoration: underline;
    }

    .notif-list {
        max-height: 320px;
        overflow-y: auto;
    }

    .notif-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 16px;
        text-decoration: none;
        transition: background .15s ease;
        position: relative;
    }

    .notif-item:hover {
        background: var(--bg-light);
    }

    .notif-item.unread {
        background: var(--accent-light);
    }

    .notif-icon-wrap {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .notif-icon-wrap i {
        font-size: 16px;
    }

    .notif-content {
        flex: 1;
        min-width: 0;
    }

    .notif-text {
        font-size: 13px;
        color: var(--text-dark);
        font-weight: 500;
        line-height: 1.4;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .notif-time {
        font-size: 11px;
        color: var(--text-light);
        margin-top: 2px;
    }

    .notif-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--accent);
        flex-shrink: 0;
        margin-top: 6px;
    }

    .notif-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 32px 16px;
        color: var(--text-light);
    }

    .notif-empty i {
        font-size: 32px;
        margin-bottom: 8px;
        opacity: 0.5;
    }

    .notif-empty span {
        font-size: 13px;
    }

    .notif-footer {
        display: block;
        text-align: center;
        padding: 12px 16px;
        font-size: 13px;
        font-weight: 600;
        color: var(--accent);
        text-decoration: none;
        border-top: 1px solid #e5e7eb;
    }

    .notif-footer:hover {
        background: var(--bg-light);
    }

    /* Responsive Topbar */
    @media (max-width: 991px) {
        .topbar-search {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .topbar {
            padding: 12px 16px;
        }

        .page-title {
            font-size: 1.2rem;
        }

        .user-info {
            display: none;
        }
    }
</style>
