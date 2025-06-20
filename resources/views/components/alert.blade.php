@php
    $flashTypes = [
        'success' => ['color' => '#28a745', 'icon' => 'check', 'title' => 'Success'],
        'warning' => ['color' => '#fd7e14', 'icon' => 'exclamation', 'title' => 'Warning'],
        'error'   => ['color' => '#dc3545', 'icon' => 'x', 'title' => 'Error'],
        'info'    => ['color' => '#007bff', 'icon' => 'info', 'title' => 'Info'],
    ];
@endphp

@foreach ($flashTypes as $type => $data)
    @if(session($type)) 
    <div class="alert d-flex align-items-center p-3 mb-3 shadow-sm"
         role="alert"
         style="border-left: 6px solid <?= $data['color'] ?>; background-color: #fff; border-radius: 6px;">
        <!-- Icon -->
        <div class="me-3 d-flex align-items-center justify-content-center"
             style="width: 32px; height: 32px; background-color: <?= $data['color'] ?>; border-radius: 50%;">
            @if($data['icon'] === 'check')
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" viewBox="0 0 16 16">
                    <path d="M13.485 1.929a.75.75 0 011.06 1.06L6.56 11.974a.75.75 0 01-1.06 0L1.454 7.929a.75.75 0 111.06-1.06L6 10.353l7.485-8.424z"/>
                </svg>
            @elseif($data['icon'] === 'exclamation')
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" viewBox="0 0 16 16">
                    <path d="M7.001 1a1 1 0 012 0v8a1 1 0 01-2 0V1zm.93 11.41a1.498 1.498 0 111.06-2.83 1.498 1.498 0 01-1.06 2.83z"/>
                </svg>
            @elseif($data['icon'] === 'x')
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 01.708 0L8 7.293l2.646-2.647a.5.5 0 11.708.708L8.707 8l2.647 2.646a.5.5 0 01-.708.708L8 8.707l-2.646 2.647a.5.5 0 01-.708-.708L7.293 8 4.646 5.354a.5.5 0 010-.708z"/>
                </svg>
            @elseif($data['icon'] === 'info')
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#fff" viewBox="0 0 16 16">
                    <path d="M8 1a7 7 0 100 14A7 7 0 008 1zM7.002 5.1a1 1 0 112 0 1 1 0 01-2 0zM8 6.5a.5.5 0 00-.5.5v4a.5.5 0 001 0v-4a.5.5 0 00-.5-.5z"/>
                </svg>
            @endif
        </div>

        <!-- Message Content -->
        <div>
            <strong class="d-block" style="color: <?= $data['color'] ?>;"><?= $data['title'] ?></strong>
            <span class="text-muted"><?= session($type) ?></span>
        </div>
    </div>
    @endif
@endforeach
