<div class="fixed bottom-0 right-0 z-50 mb-4 mr-4">
    <button id="open-chat" class="flex items-center px-4 py-2 text-white transition duration-300 bg-pink-500 rounded-md hover:bg-pink-600">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        Chat Box
    </button>
</div>
<div class="fixed bottom-0 right-0 z-50 hidden w-6/12 bg-white border rounded lg:grid lg:grid-cols-3 hidden-important" id="form-chat">
    <div class="border-r border-gray-300 lg:col-span-1">
        <div class="mx-3 my-3">
            <div class="relative text-gray-600">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        viewBox="0 0 24 24" class="w-6 h-6 text-gray-300">
                        <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="search" class="block w-full py-2 pl-10 bg-gray-100 rounded outline-none" name="search"
                    placeholder="Search" required />
            </div>
        </div>

        <ul class="overflow-auto h-[26rem] overflow-list-user-chat">
            <li class="list-user-chat">
            </li>
        </ul>
    </div>
    <div class="hidden lg:col-span-2 lg:block div-chat-detail">
        <div class="w-full">
            <div class="relative flex items-center justify-between p-3 border-b border-gray-300">
                <img class="object-cover w-10 h-10 rounded-full avatar-chat-detail"
                    src="https://dummyimage.com/800x700/000000/ffffff&text=Avatar" alt="username" />
                <span class="block ml-2 font-bold text-gray-600 name-chat-detail"></span>
                <span class="absolute w-3 h-3 bg-green-600 rounded-full left-10 top-3">
                </span>
                <div class="flex justify-end">
                    <button type="button"
                        class="relative p-2 -m-2 text-gray-400 hover:text-gray-500 " id="btn-hidden-chat">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Close panel</span>
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="relative w-full p-6 overflow-y-auto h-[23rem] overflow-full-chat">
                <ul class="space-y-2 full-chat-ul" >
                    <div class="flex justify-center">
                        <img src="{{ url('images/logo/live-chat.png') }}" alt="">
                    </div>
                    <span class="flex justify-center">Chào mừng bạn đến với Anon Chat</span>
                </ul>
            </div>

            <div class="flex items-center justify-between w-full p-3 border-t border-gray-300" >
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                </button>
                    <input type="text" placeholder="Message"
                        class="block w-full py-2 pl-4 mx-3 bg-gray-100 rounded-full outline-none focus:text-gray-700 message-chat" required />
                    <button type="submit" class="btn-send-chat">
                        <svg class="w-5 h-5 text-gray-500 origin-center transform rotate-90"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path
                                d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z" />
                        </svg>
                    </button>
            </div>
        </div>
    </div>
</div>

