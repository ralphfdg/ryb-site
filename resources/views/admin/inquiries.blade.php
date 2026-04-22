@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-2xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                <span class="text-white">Admin</span> <span class="text-[#e52a2a]">Inquiries</span>
            </h2>
            <p class="text-[#666666] text-xs">Manage customer messages and test drive requests.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 h-[calc(100vh-160px)]">
        
        <div class="bg-[#111111] border border-[#1a1a1a] rounded-xl flex flex-col h-full overflow-hidden">
            <div class="p-5 border-b border-[#1a1a1a]">
                <h3 class="text-[11px] font-bold text-white tracking-widest uppercase font-['Oswald'] mb-3">Incoming Messages</h3>
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-[#666666]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Search inquiries..." class="w-full bg-[#050505] border border-[#1a1a1a] text-xs text-white pl-9 pr-4 py-2 rounded-md focus:outline-none focus:border-[#e52a2a]">
                </div>
            </div>
            
            <div class="flex-1 overflow-y-auto p-3 space-y-2">
                <div class="bg-[#1a1a1a] border-l-2 border-[#e52a2a] p-4 rounded-r-lg cursor-pointer">
                    <div class="flex justify-between items-start mb-2">
                        <span class="px-2 py-0.5 bg-yellow-500/10 text-yellow-500 rounded text-[8px] font-bold uppercase tracking-wider border border-yellow-500/20">New</span>
                        <span class="text-[9px] text-[#666666]">Apr 22, 9:45 AM</span>
                    </div>
                    <h4 class="text-sm font-bold text-white mb-1">John Smith</h4>
                    <p class="text-[10px] text-[#888888] line-clamp-2">Hi, I am interested in the 2024 Honda Accord EX-L. Is it still available? I would like to schedule a test drive...</p>
                </div>

                <div class="bg-[#0a0a0a] hover:bg-[#151515] border border-transparent p-4 rounded-lg cursor-pointer transition-colors">
                    <div class="flex justify-between items-start mb-2">
                        <span class="px-2 py-0.5 bg-[#2ecc71]/10 text-[#2ecc71] rounded text-[8px] font-bold uppercase tracking-wider border border-[#2ecc71]/20">Resolved</span>
                        <span class="text-[9px] text-[#666666]">Apr 21, 4:15 PM</span>
                    </div>
                    <h4 class="text-sm font-bold text-gray-400 mb-1">Michael Chen</h4>
                    <p class="text-[10px] text-[#666666] line-clamp-2">Is this truck still on the lot? I would like to come see it today if possible.</p>
                </div>

                <div class="bg-[#0a0a0a] hover:bg-[#151515] border border-transparent p-4 rounded-lg cursor-pointer transition-colors">
                    <div class="flex justify-between items-start mb-2">
                        <span class="px-2 py-0.5 bg-yellow-500/10 text-yellow-500 rounded text-[8px] font-bold uppercase tracking-wider border border-yellow-500/20">New</span>
                        <span class="text-[9px] text-[#666666]">Apr 20, 11:20 AM</span>
                    </div>
                    <h4 class="text-sm font-bold text-gray-400 mb-1">Emily Rodriguez</h4>
                    <p class="text-[10px] text-[#666666] line-clamp-2">Does this vehicle qualify for any federal or state EV incentives? Also wondering about charging station installation...</p>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 bg-[#111111] border border-[#1a1a1a] rounded-xl flex flex-col h-full overflow-hidden">
            
            <div class="p-6 border-b border-[#1a1a1a] flex justify-between items-start">
                <div class="flex gap-4 items-center">
                    <div class="w-10 h-10 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[#888] font-bold font-['Oswald'] tracking-wider">JS</div>
                    <div>
                        <h3 class="text-lg font-bold text-white">John Smith</h3>
                        <p class="text-[11px] text-[#666666]">john.smith@email.com</p>
                    </div>
                </div>
                <span class="px-3 py-1 bg-yellow-500/10 text-yellow-500 rounded text-[9px] font-bold uppercase tracking-wider border border-yellow-500/20">Unresolved</span>
            </div>
            
            <div class="bg-[#0a0a0a] border-b border-[#1a1a1a] p-4 flex items-center gap-3">
                <svg class="w-4 h-4 text-[#e52a2a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="text-[11px] text-[#888888]">Inquiring About: <span class="font-bold text-white ml-1">2024 Honda Accord EX-L</span></p>
            </div>

            <div class="p-6 flex-1 overflow-y-auto">
                <div class="bg-[#050505] border border-[#1a1a1a] p-6 rounded-lg">
                    <p class="text-xs text-gray-300 leading-loose">
                        Hi, I am interested in the 2024 Honda Accord EX-L. Is it still available? I would like to schedule a test drive this weekend if possible.<br><br>
                        Also, can you provide information about financing options? I have excellent credit and am looking for the best rates available. Thank you!
                    </p>
                </div>
            </div>

            <div class="p-6 border-t border-[#1a1a1a] bg-[#0a0a0a]">
                <h4 class="text-[11px] font-bold text-white tracking-widest uppercase font-['Oswald'] mb-3">Reply to Customer</h4>
                <textarea class="w-full bg-[#111111] border border-[#1a1a1a] text-xs text-white p-4 rounded-lg focus:outline-none focus:border-[#e52a2a] mb-4 transition-colors" rows="4" placeholder="Type your reply here..."></textarea>
                
                <div class="flex justify-between items-center">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <div class="relative flex items-center justify-center w-4 h-4 border border-[#333] bg-[#111] rounded group-hover:border-[#e52a2a] transition-colors">
                            <input type="checkbox" class="peer opacity-0 absolute w-full h-full cursor-pointer">
                            <svg class="w-3 h-3 text-[#e52a2a] opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-xs text-[#666666] group-hover:text-white transition-colors">Mark as Resolved</span>
                    </label>
                    
                    <button class="bg-[#e52a2a] hover:bg-[#c41d1d] text-white px-6 py-2.5 rounded-md text-[11px] font-bold uppercase tracking-wider transition-colors shadow-[0_0_10px_rgba(229,42,42,0.2)]">
                        Send Reply
                    </button>
                </div>
            </div>
            
        </div>
    </div>
@endsection