@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div class="w-full">
                <h2 class="text-2xl font-bold font-['Oswald'] tracking-wide uppercase mb-1">
                    <span class="text-white">Customer</span> <span class="text-[#e52a2a]">Management</span>
                </h2>
                <p class="text-[#666666] text-xs">View and manage your registered client base.</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto justify-end">
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-2.5 text-[#666666]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" placeholder="Search customers..." class="bg-[#0a0a0a] border border-[#1a1a1a] text-xs text-white pl-9 pr-4 py-2 rounded-md focus:outline-none focus:border-[#e52a2a] w-64 transition-colors">
                </div>
                <button class="bg-[#111111] border border-[#1a1a1a] text-white px-4 py-2 rounded-md text-[11px] font-bold hover:bg-[#1a1a1a] transition-colors uppercase tracking-wider">
                    Export List
                </button>
            </div>
        </div>

        <div class="bg-[#111111] rounded-xl border border-[#1a1a1a] overflow-hidden p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-nowrap">
                    <thead class="text-[10px] uppercase text-[#666666] border-b border-[#1a1a1a] tracking-widest">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-center w-24">ID</th>
                            <th class="px-6 py-4 font-semibold">Customer Name</th>
                            <th class="px-6 py-4 font-semibold">Email Address</th>
                            <th class="px-6 py-4 font-semibold">Joined Date</th>
                            <th class="px-6 py-4 font-semibold text-center">Total Purchases</th>
                            <th class="px-6 py-4 font-semibold">Account Status</th>
                            <th class="px-6 py-4 font-semibold text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#1a1a1a] text-xs">
                        
                        <tr class="hover:bg-[#151515] transition-colors group">
                            <td class="px-6 py-4 text-[#e52a2a] font-bold text-center">U-0842</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">MC</div>
                                    <span class="text-white font-medium">Michael Chen</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#888]">michael.chen@example.com</td>
                            <td class="px-6 py-4 text-[#888]">Jan 12, 2026</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-[#1a1a1a] text-white rounded-full border border-[#333] text-[11px]">2 Cars</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Verified</span>
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#151515] transition-colors group">
                            <td class="px-6 py-4 text-[#e52a2a] font-bold text-center">U-0843</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">SR</div>
                                    <span class="text-white font-medium">Sarah Johnson</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#888]">s.johnson@testmail.com</td>
                            <td class="px-6 py-4 text-[#888]">Feb 05, 2026</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-transparent text-[#666] rounded-full border border-[#333] text-[11px]">0 Cars</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Verified</span>
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#151515] transition-colors group">
                            <td class="px-6 py-4 text-[#e52a2a] font-bold text-center">U-0844</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">JS</div>
                                    <span class="text-white font-medium">John Smith</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#888]">john.smith@email.com</td>
                            <td class="px-6 py-4 text-[#888]">Mar 18, 2026</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-[#1a1a1a] text-white rounded-full border border-[#333] text-[11px]">1 Car</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-yellow-500/10 text-yellow-500 rounded border border-yellow-500/20 text-[9px] font-bold uppercase tracking-wider">Pending</span>
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#151515] transition-colors group">
                            <td class="px-6 py-4 text-[#e52a2a] font-bold text-center">U-0845</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">ER</div>
                                    <span class="text-white font-medium">Emily Rodriguez</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#888]">emily.r@company.net</td>
                            <td class="px-6 py-4 text-[#888]">Mar 22, 2026</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-[#1a1a1a] text-white rounded-full border border-[#333] text-[11px]">3 Cars</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Verified</span>
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#151515] transition-colors group">
                            <td class="px-6 py-4 text-[#e52a2a] font-bold text-center">U-0846</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">DM</div>
                                    <span class="text-white font-medium">David Martinez</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#888]">david.m1980@gmail.com</td>
                            <td class="px-6 py-4 text-[#888]">Apr 02, 2026</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-[#1a1a1a] text-white rounded-full border border-[#333] text-[11px]">1 Car</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Verified</span>
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#151515] transition-colors group">
                            <td class="px-6 py-4 text-[#e52a2a] font-bold text-center">U-0847</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">AL</div>
                                    <span class="text-white font-medium">Amanda Lee</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#888]">amanda.lee@yahoo.com</td>
                            <td class="px-6 py-4 text-[#888]">Apr 15, 2026</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-transparent text-[#666] rounded-full border border-[#333] text-[11px]">0 Cars</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-yellow-500/10 text-yellow-500 rounded border border-yellow-500/20 text-[9px] font-bold uppercase tracking-wider">Pending</span>
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#151515] transition-colors group">
                            <td class="px-6 py-4 text-[#e52a2a] font-bold text-center">U-0848</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">RW</div>
                                    <span class="text-white font-medium">Robert Wilson</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#888]">r.wilson.auto@outlook.com</td>
                            <td class="px-6 py-4 text-[#888]">Apr 20, 2026</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-[#1a1a1a] text-white rounded-full border border-[#333] text-[11px]">4 Cars</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Verified</span>
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#151515] transition-colors group">
                            <td class="px-6 py-4 text-[#e52a2a] font-bold text-center">U-0849</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">JT</div>
                                    <span class="text-white font-medium">Jessica Taylor</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#888]">jtaylor99@gmail.com</td>
                            <td class="px-6 py-4 text-[#888]">Apr 21, 2026</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-[#1a1a1a] text-white rounded-full border border-[#333] text-[11px]">1 Car</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Verified</span>
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#151515] transition-colors group">
                            <td class="px-6 py-4 text-[#e52a2a] font-bold text-center">U-0850</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">KN</div>
                                    <span class="text-white font-medium">Kevin Nguyen</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#888]">kevin.nguyen_cars@yahoo.com</td>
                            <td class="px-6 py-4 text-[#888]">Apr 21, 2026</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-[#1a1a1a] text-white rounded-full border border-[#333] text-[11px]">2 Cars</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-[#051c0d] text-[#2ecc71] rounded border border-[#0a381a] text-[9px] font-bold uppercase tracking-wider">Verified</span>
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-[#151515] transition-colors group">
                            <td class="px-6 py-4 text-[#e52a2a] font-bold text-center">U-0851</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-[#1a1a1a] border border-[#333] flex items-center justify-center text-[10px] text-white font-bold uppercase">MG</div>
                                    <span class="text-white font-medium">Maria Garcia</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-[#888]">m.garcia.design@gmail.com</td>
                            <td class="px-6 py-4 text-[#888]">Apr 22, 2026</td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-3 py-1 bg-transparent text-[#666] rounded-full border border-[#333] text-[11px]">0 Cars</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-yellow-500/10 text-yellow-500 rounded border border-yellow-500/20 text-[9px] font-bold uppercase tracking-wider">Pending</span>
                            </td>
                            <td class="px-6 py-4 flex justify-end gap-2">
                                <button class="px-4 py-1.5 rounded bg-[#1a1a1a] border border-[#2a2a2a] text-[#666] hover:text-white hover:border-[#e52a2a] transition-all text-[10px] font-bold uppercase">View Profile</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-between items-center mt-6 pt-6 border-t border-[#1a1a1a]">
                <p class="text-[11px] text-[#666]">Showing 10 of 487 registered customers</p>
                <div class="flex gap-1">
                    <button class="w-8 h-8 rounded bg-[#1a1a1a] border border-[#2a2a2a] flex items-center justify-center text-[#666] hover:text-white transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <button class="w-8 h-8 rounded bg-[#e52a2a] flex items-center justify-center text-white text-[11px] font-bold">1</button>
                    <button class="w-8 h-8 rounded bg-[#1a1a1a] border border-[#2a2a2a] flex items-center justify-center text-[#666] hover:text-white transition-colors text-[11px]">2</button>
                    <button class="w-8 h-8 rounded bg-[#1a1a1a] border border-[#2a2a2a] flex items-center justify-center text-[#666] hover:text-white transition-colors text-[11px]">3</button>
                    <button class="w-8 h-8 rounded bg-[#1a1a1a] border border-[#2a2a2a] flex items-center justify-center text-[#666] hover:text-white transition-colors">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection