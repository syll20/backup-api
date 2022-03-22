@if(session()->has('success'))
<div 
    x-data="{show: true}"
    x-init="setTimeout( () => show = false, 4000)"
    x-show="show"
    class="fixed top-10 right-3 bg-blue-500 text-white py-2 px-4 rounded-xl ">{{ session('success') }}</div>
@endif