
import './bootstrap';

function initializeLiveNotifications() {
    const header = document.querySelector('header[data-auth-user-id]');
    const userId = header?.dataset.authUserId;

    if (!userId || !window.Echo) {
        return;
    }

    // Listen to the authenticated user's private notification channel.
    window.Echo
        .private(`App.Models.User.${userId}`)
        .notification((notification) => {

            console.log('New TeamUp notification:', notification);

            // 1. Update desktop and mobile notification badges.
            document.querySelectorAll('[data-notification-count]').forEach((badge) => {
                const currentCount = Number(badge.dataset.count || 0);
                const newCount = currentCount + 1;

                badge.dataset.count = newCount;
                badge.textContent = newCount > 99 ? '99+' : newCount;
                badge.classList.remove('hidden');
            });

            // 2. Create the toast container if it doesn't exist.
            let container = document.getElementById('teamup-live-toasts');

            if (!container) {
                container = document.createElement('div');
                container.id = 'teamup-live-toasts';

                container.className =
                    'fixed top-20 right-4 z-[100] w-[calc(100%-2rem)] max-w-sm space-y-3';

                document.body.appendChild(container);
            }

            // 3. Create the notification toast.
            const toast = document.createElement('a');

            toast.href = notification.url || '/notifications';

            toast.className =
                'flex items-start gap-3 p-4 bg-white dark:bg-gray-800 ' +
                'border border-gray-200 dark:border-gray-700 rounded-2xl ' +
                'shadow-xl transition-all duration-300 hover:shadow-2xl';

            // Notification icon.
            const iconWrapper = document.createElement('div');

            iconWrapper.className =
                'w-10 h-10 shrink-0 rounded-xl bg-sky-50 dark:bg-sky-950/50 ' +
                'text-sky-600 dark:text-sky-400 flex items-center justify-center';

            const icon = document.createElement('i');
            icon.className = `fa-solid ${notification.icon || 'fa-bell'}`;

            iconWrapper.appendChild(icon);

            // Notification content.
            const content = document.createElement('div');
            content.className = 'min-w-0 flex-1';

            const title = document.createElement('p');
            title.className =
                'text-sm font-bold text-gray-900 dark:text-white';

            title.textContent = notification.title || 'New Notification';

            const message = document.createElement('p');
            message.className =
                'mt-1 text-xs text-gray-500 dark:text-gray-400';

            message.textContent = notification.message || '';

            const label = document.createElement('p');
            label.className =
                'mt-2 text-[10px] font-semibold uppercase tracking-wider text-sky-600 dark:text-sky-400';

            label.textContent = 'New notification';

            content.append(title, message, label);
            toast.append(iconWrapper, content);

            container.appendChild(toast);

            // 4. Remove toast automatically after 6 seconds.
            setTimeout(() => {
                toast.classList.add('opacity-0', 'translate-x-4');

                setTimeout(() => {
                    toast.remove();

                    if (container && container.children.length === 0) {
                        container.remove();
                    }
                }, 300);
            }, 6000);

            // 5. Notify other frontend components about the new notification.
            window.dispatchEvent(
                new CustomEvent('teamup:notification', {
                    detail: notification
                })
            );
        });
}

// Make sure the DOM is ready before initializing Echo.
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeLiveNotifications);
} else {
    initializeLiveNotifications();
}
