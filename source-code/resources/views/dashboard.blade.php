@livewireStyles
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <script>

                        const countDown = () => {
                        const endTime = new Date("Jul 25, 2023 16:37:52").getTime();

                        const timer = setInterval(() => {
                        const currentTime = new Date().getTime()
                        let timeLeft = endTime - currentTime

                        
                        // let days = Math.floor(timeleft / (1000 * 60 * 60 * 24))
                        // let hours = Math.floor((timeleft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
                        // let minutes = Math.floor((timeleft % (1000 * 60 * 60)) / (1000 * 60))
                        // let seconds = Math.floor((timeleft % (1000 * 60)) / 1000)
                        

                        console.log(timeLeft)
                        
                        if (timeLeft <= 0) {
                            clearInterval(timer)
                            return 'time up'
                        }
                        }, 1000)
}

                        countDown()

                    </script>
                    <livewire:count-down>
                </div>

            </div>
        </div>
    </div>
    @livewireScripts

</x-app-layout>
