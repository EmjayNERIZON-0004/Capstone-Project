@extends('layout.layout_office')

@section('title', 'Notifications') 
 
@section('content')
<div class="container py-4">
    <div class="card shadow border-0 rounded-3 overflow-hidden">
    <div class="card-header d-flex justify-content-between align-items-center bg-white border-bottom px-3 py-2">
    <div class="d-flex align-items-center">
        
        <h5 class="mb-0 fw-semibold text-dark" style="font-size: 26px;">Notifications</h5>
    </div>
            @if(!$notifications->isEmpty())
            <div class="dropdown">
                <button class="btn btn-sm btn-light" type="button" id="notificationActions" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationActions">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-check-double me-2"></i>Mark all as read</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
  <a  class="dropdown-item text-danger clear-notifications" data-office-id="{{ session('office_id') }}">
    <i class="fas fa-trash me-2"></i>Clear all
  </a>
</li>
   </ul>
            </div>

            <script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.clear-notifications').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const officeId = this.getAttribute('data-office-id');

            if (!confirm("Are you sure you want to clear all notifications for this office?")) return;

            fetch('/notifications/clear', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ office_id: officeId })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.success || "Notifications cleared!");
                location.reload(); // Refresh the page or update UI dynamically
            })
            .catch(err => {
                console.error(err);
                alert("Failed to clear notifications.");
            });
        });
    });
});
</script>

            @endif
        </div>

        <div class="card-body p-0">
            @if($notifications->isEmpty())  
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-bell-slash fa-4x text-muted"></i>
                    </div>
                    <h5 class="text-muted">No notifications yet</h5>
                    <p class="text-muted mb-0">When you receive notifications, they will appear here</p>
                </div>
            @else
                <div class="notification-list">
                    @foreach ($notifications as $notification)
                        <div class="notification-item position-relative {{ $notification->is_read == 'no' ? 'unread' : '' }}" id="notif-{{ $notification->id }}">
                            <div class="d-flex align-items-start p-3 border-bottom">
                                <div class="flex-shrink-0 me-3">
                                    <div class="notification-icon {{ $notification->is_read == 'no' ? 'bg-primary' : 'bg-secondary' }}">
                                        <i class="fas fa-bell text-white"></i>
                                    </div>
                                </div>
                                
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 fw-bold">{{ $notification->title }}</h6>
                                        <small class="text-muted ms-2">
                                            {{ $notification->created_at ? $notification->created_at->diffForHumans() : 'Unknown time' }}
                                        </small>
                                    </div>
                                    <p class="notification-preview mb-2">
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- <button style="font-size: 16px;" class="btn btn-sm btn-primary px-3" onclick="viewNotification(<?php echo $notification->id ?>)">
                                            View Details
                                        </button>
                                         -->
                                        <p>   {{ \Illuminate\Support\Str::limit(strip_tags($notification->message ?? 'No message content'), 100) }}
                                        </p>
                                        <div class="notification-actions">
                                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-secondary" 
                                                   onclick="return confirm('Are you sure you want to delete this notification?');">
                                                   <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            @if($notification->is_read == 'no')
                                <span class="position-absolute top-0 end-0 translate-middle-y badge bg-primary rounded-pill mt-3 me-3">
                                    New
                                </span>
                            @endif
                        </div>
                    @endforeach
                </div>
                 
            @endif
        </div>
    </div>
</div><!-- Notification Detail Modal -->
<div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 bg-white rounded-2">

            <!-- Body -->
            <div class="modal-body px-5 py-4">
                <div class="mb-4">
                    <h4 id="notificationTitle" class="fw-semibold text-dark m-0" style="font-size: 1.5rem;">Notification Title</h4>
                </div>
                <!-- Top Bar: Sender + Date -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="text-dark small" style="font-size: 1rem;">From: <strong>SDO-SCC Administrator</strong></div>
                    <div class="text-muted small" id="date_time" style="font-size: 1rem;">April 6, 2025</div>
                </div>

                <!-- Message -->
                <div id="notificationMessage" class="text-muted lh-lg" style="font-size: 1.125rem; line-height: 1.6;"></div>
            </div>

            <!-- Footer -->
            <div class="px-5 py-3 d-flex justify-content-end gap-2 border-top">
                <button type="button" class="btn btn-sm btn-light px-3" data-bs-dismiss="modal" style="font-size: 1rem;border:1px solid #ccc">Close</button>
                <button type="button" class="btn btn-sm btn-dark px-3" onclick="markAsRead()" data-bs-dismiss="modal" style="font-size: 1rem;">
                    Mark as Read
                </button>
            </div>
        </div>
    </div>
</div>



<style>
    /* Main card styling */
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .card-header {
        border-bottom: none;
    }
    
    /* Notification list item styling */
    .notification-list {
        max-height: 70vh;
        overflow-y: auto;
    }
    
    .notification-item {
        transition: all 0.2s ease;
        border-left: 4px solid transparent;
    }
    
    .notification-item:hover {
        background-color: rgba(0,0,0,0.02);
    }
    
    .notification-item.unread {
        background-color: rgba(13, 110, 253, 0.05);
        border-left: 4px solid #0d6efd;
    }
    
    /* Notification icon styling */
    .notification-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #6c757d;
    }
    
    .notification-icon i {
        font-size: 1rem;
    }
    
    /* Notification preview text */
    .notification-preview {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    /* Modal styling */
    .modal-content {
        border-radius: 0.5rem;
        overflow: hidden;
    }
    
    .modal-header {
        border-bottom: none;
        padding: 1rem 1.5rem;
    }
    
    .modal-footer {
        border-top: none;
        padding: 1rem 1.5rem;
    }
    
    .notification-content {
        font-size: 1rem;
        line-height: 1.6;
    }
    
    /* Responsive adjustments */
    @media (max-width: 767px) {
        .notification-item .d-flex {
            flex-direction: column;
        }
        
        .notification-icon {
            margin-bottom: 1rem;
        }
        
        .notification-actions {
            margin-top: 0.5rem;
        }
    }
    
    /* Custom scrollbar for notification list */
    .notification-list::-webkit-scrollbar {
        width: 6px;
    }
    
    .notification-list::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    
    .notification-list::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 3px;
    }
    
    .notification-list::-webkit-scrollbar-thumb:hover {
        background: #a8a8a8;
    }
    
    /* Fix for small screens */
    @media (max-width: 576px) {
        .notification-item .d-flex {
            flex-direction: row;
        }
        
        .notification-item .d-flex .flex-grow-1 {
            width: calc(100% - 60px);
        }
        
        .notification-actions {
            margin-top: 0.5rem;
        }
        
        .notification-item .d-flex .justify-content-between {
            flex-direction: column;
            align-items: flex-start !important;
        }
        
        .notification-item .d-flex .justify-content-between small {
            margin-left: 0 !important;
            margin-top: 0.25rem;
        }
    }
</style>

<script>
    // View notification details
    function viewNotification(id) {
        console.log("Fetching notification for ID:", id);

        fetch(`/office/notifications/${id}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('notificationTitle').innerText = data.title;
                document.getElementById('notificationMessage').innerHTML = data.message;
                document.getElementById('date_time').innerHTML = `<i class="far fa-clock me-1"></i> ${data.date_time}`;

                // Mark as read visually
                const notificationElement = document.getElementById(`notif-${id}`);
                if (notificationElement) {
                    notificationElement.classList.remove('unread');
                }

                // Show modal
                const notificationModal = new bootstrap.Modal(document.getElementById('notificationModal'));
                notificationModal.show();
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                alert('Failed to load notification details.');
            });
    }
    
    // Mark notification as read
    function markAsRead(id) {
        // This would typically make an AJAX call to your backend
        console.log("Marking notification as read:", id);
        
        // For demonstration, we'll just refresh the page
        // In production, you would make an AJAX call and then update the UI
        setTimeout(() => {
            location.reload();
        }, 300);
    }
    
    // Delete notification
    function deleteNotification(id) {
        if (confirm("Are you sure you want to delete this notification?")) {
            fetch(`/notifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const element = document.getElementById(`notif-${id}`);
                    element.style.height = '0';
                    element.style.opacity = '0';
                    setTimeout(() => {
                        element.remove();
                    }, 300);
                } else {
                    alert("Failed to delete notification.");
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Something went wrong.");
            });
        }
    }
    
    // Initialize Bootstrap components
    document.addEventListener('DOMContentLoaded', function() {
        // Add any initialization code here if needed
    });
</script>
@endsection