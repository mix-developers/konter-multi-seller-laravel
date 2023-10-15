@push('css')
    <style>
        ::-webkit-scrollbar {
            width: 10px
        }

        ::-webkit-scrollbar-track {
            background: #eee
        }

        ::-webkit-scrollbar-thumb {
            background: #888
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555
        }

        .wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            align-rooms: center;
        }

        .main {
            background-color: #eee;
            width: 100%;
            position: relative;
            border-radius: 8px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 6px 0px 0px 0px
        }

        .scroll {
            overflow-y: scroll;
            scroll-behavior: smooth;
            height: 325px
        }

        .name {
            font-size: 10px
        }

        .msg {
            background-color: #fff;
            font-size: 12px;
            padding: 5px;
            border-radius: 5px;
            font-weight: 500;
            color: #3e3c3c
        }
    </style>
@endpush
{{-- {{ dd($room_user) }} --}}
@foreach ($room_user as $room)
    <div class="tab-pane fade" id="v-pills-{{ $room->chat_room_id }}" role="tabpanel"
        aria-labelledby="v-pills-{{ $room->chat_room_id }}-tab">
        <div class="d-flex justify-content-center container ">
            <div class="wrapper">
                <div class="main">
                    <div class="px-2 scroll" id="message-{{ $room->chat_room_id }}">
                    </div>
                    <form id="form-{{ $room->chat_room_id }}"
                        class="navbar bg-white navbar-expand-sm d-flex justify-content-between">
                        <input type="text" name="text" class="form-control" placeholder="Type a message...">
                        <button class="btn btn-success">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
        {{-- Load pusher library --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get chat from API
                const getChat = async () => {
                    const response = await fetch('/chat/get/{{ $room->chat_room_id }}');
                    const data = await response.json()

                    let chatsHTML = '';

                    data.map(r => {
                        const createdAt = new Date(r.created_at);
                        const timeString = createdAt.toLocaleTimeString('en-US', {
                            hour: 'numeric',
                            minute: 'numeric'
                        });
                        chatsHTML += `
                            <div class="d-flex align-rooms-center 
                                ${r.user_id == "{{ Auth::user()->id }}" ? 'text-right justify-content-end' : ''}">
                                <div class="pr-2 ${r.user_id == "{{ Auth::user()->id }}" ? '' : 'pl-1'}">
                                    <span class="name">${r.user_id == "{{ Auth::user()->id }}" ? 'Anda' : r.user_name} | ${timeString}</span>
                                    <p class="msg">${r.message}</p>
                                </div>
                            </div>`
                    });

                    document.getElementById('message-{{ $room->chat_room_id }}').innerHTML = chatsHTML
                }

                const roomId = "{{ $room->chat_room_id }}";

                window.addEventListener('load', async (ev) => {
                    await getChat()
                    // Connect to pusher
                    const pusher = new Pusher("{{ env('PUSHER_APP_KEY') }}", {
                        cluster: "{{ env('PUSHER_APP_CLUSTER') }}"
                    });

                    // Connect to chat channel
                    const channel = pusher.subscribe(`chat-channel`);

                    // Listen for chat-send event
                    channel.bind('chat-send', async (data) => {
                        await getChat();
                    });
                    // Send message
                    document.getElementById(`form-${roomId}`).addEventListener('submit', async (ev) => {
                        ev.preventDefault();

                        const message = document.querySelector(
                            `#v-pills-${roomId} input[name="text"]`);
                        const response = await fetch('/chat/send', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                message: message.value,
                                room: roomId
                            })
                        });

                        const data = await response.json();
                        if (data) {
                            // Get chat
                            await getChat();

                            message.value = '';
                        }
                    })
                });

                // Initial chat loading
                getChat();
            });
        </script>
    @endpush
@endforeach
