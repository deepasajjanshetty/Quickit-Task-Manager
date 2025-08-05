<template>
  <div class="space-y-6">
    <div class="bg-black rounded-2xl shadow-sm hover:shadow-md transition-shadow">
      <!-- Blue gradient header section -->
      <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-8 rounded-t-3xl">
        <div class="flex justify-between items-start">
          <div >
            <nav class="flex items-center space-x-2 text-sm text-blue-100 mb-1">
              <a href="#" @click.prevent="goToAllProjects" class="hover:text-white transition-colors">Projects</a>
              <span>/</span>
              <span class="text-white">Software Projects</span>
            </nav>
            <div class="flex items-center gap-4">
              <h2 class="text-3xl font-bold text-white">{{ currentProjectTitle }}</h2>
              <div class="relative">
                <button @click="toggleProjectDropdown" class="bg-blue-400 hover:bg-blue-300 text-white text-sm px-3 py-1 rounded-2xl transition-colors">
                  Change
                </button>
                <!-- Project Dropdown -->
                <div v-if="showProjectDropdown" class="absolute top-full left-0 mt-2 bg-gray-800 border border-gray-700 rounded-lg shadow-lg min-w-[200px] z-50">
                  <div class="p-2">
                    <div 
                      v-for="project in projectList" 
                      :key="project.type"
                      @click="changeProject(project.type)"
                      class="flex items-center gap-3 px-3 py-2 text-white hover:bg-gray-700 rounded-lg transition-colors cursor-pointer"
                    >
                      <div class="w-4 h-4 rounded flex items-center justify-center" :class="getProjectIconClass(project.type)">
                        <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 24 24">
                          <path v-if="project.type === 'software'" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                          <path v-else-if="project.type === 'web'" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                          <path v-else d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        </svg>
                      </div>
                      <span class="text-sm">{{ project.name }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-right">
            <div class="text-white text-sm mt-10">
              <span>Customer: Mike Johnson</span>
              <i class='bx bx-link'></i> 
            </div>
          </div>
        </div>
      </div>
      <!-- Dark gray details section -->
      <div class="bg-gray-800 p-8 rounded-b-3xl">
        <div class="flex justify-between items-start">
          <!-- Left side: Priority, Start Date, Due Date, Tags -->
          <div class="flex gap-6">
            <div>
              <p class="text-gray-400 text-xs mb-1">Priority</p>
              <div class="relative">
                <button @click="togglePriorityDropdown" class="flex items-center gap-2 bg-gray-700 text-white text-xs px-3 py-1 rounded-sm hover:bg-gray-600 transition-colors">
                  <span :class="getPriorityColorClass(selectedPriority)">{{ selectedPriority }}</span>
                  <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
                </button>
                <!-- Priority Dropdown -->
                <div v-if="showPriorityDropdown" class="absolute top-full left-0 mt-1 bg-gray-800 border border-gray-700 rounded-lg shadow-lg min-w-[120px]" style="z-index: 99999;">
                  <div class="p-1">
                    <div 
                      v-for="priority in priorityOptions" 
                      :key="priority"
                      @click="changePriority(priority)"
                      class="flex items-center gap-2 px-3 py-2 text-white hover:bg-gray-700 rounded-lg transition-colors cursor-pointer"
                    >
                      <div class="w-2 h-2 rounded-full" :class="getPriorityColorClass(priority)"></div>
                      <span class="text-xs">{{ priority }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div>
              <p class="text-gray-400 text-xs mb-1">Start Date</p>
              <div class="relative">
                <button @click="toggleStartDatePicker" data-date-button="start" class="flex items-center gap-2 text-white text-sm hover:text-gray-300 transition-colors">
                  <span>{{ formatDate(selectedStartDate) }}</span>
                  
                </button>
                <!-- Start Date Picker -->
                <div v-if="showStartDatePicker" data-date-picker="start" class="absolute top-full left-0 mt-2 bg-gray-800 border border-gray-700 rounded-lg shadow-lg z-50 min-w-[280px]">
                  <div class="p-4 relative">
                    <div class="flex items-center justify-between mb-4">
                      <button @click="previousMonth" class="text-gray-400 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                      </button>
                      <span class="text-white font-medium">{{ currentMonthYear }}</span>
                      <button @click="nextMonth" class="text-gray-400 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                      </button>
                    </div>
                    <div class="grid grid-cols-7 gap-1 mb-2">
                      <div v-for="day in ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']" :key="day" class="text-gray-400 text-xs text-center py-1">
                        {{ day }}
                      </div>
                    </div>
                    <div class="grid grid-cols-7 gap-1">
                      <div 
                        v-for="date in calendarDates" 
                        :key="date.key"
                        @click="selectStartDate(date)"
                        :class="[
                          'text-center py-2 text-sm cursor-pointer rounded hover:bg-gray-700 transition-colors',
                          date.isCurrentMonth ? 'text-white' : 'text-gray-600',
                          date.isSelected ? 'bg-blue-500 text-white' : '',
                          date.isToday ? 'bg-gray-600 text-white' : ''
                        ]"
                      >
                        {{ date.day }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div>
              <p class="text-gray-400 text-xs mb-1">Due Date</p>
              <div class="relative">
                <button @click="toggleDueDatePicker" data-date-button="due" class="flex items-center gap-2 text-white text-sm hover:text-gray-300 transition-colors">
                  <span>{{ formatDate(selectedDueDate) }}</span>
                  
                </button>
                <!-- Due Date Picker -->
                <div v-if="showDueDatePicker" data-date-picker="due" class="absolute top-full left-0 mt-2 bg-gray-800 border border-gray-700 rounded-lg shadow-lg z-50 min-w-[280px]">
                  <div class="p-4 relative">
                    <div class="flex items-center justify-between mb-4">
                      <button @click="previousDueMonth" class="text-gray-400 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                      </button>
                      <span class="text-white font-medium">{{ currentDueMonthYear }}</span>
                      <button @click="nextDueMonth" class="text-gray-400 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                      </button>
                    </div>
                    <div class="grid grid-cols-7 gap-1 mb-2">
                      <div v-for="day in ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']" :key="day" class="text-gray-400 text-xs text-center py-1">
                        {{ day }}
                      </div>
                    </div>
                    <div class="grid grid-cols-7 gap-1">
                      <div 
                        v-for="date in dueCalendarDates" 
                        :key="date.key"
                        @click="selectDueDate(date)"
                        :class="[
                          'text-center py-2 text-sm cursor-pointer rounded hover:bg-gray-700 transition-colors',
                          date.isCurrentMonth ? 'text-white' : 'text-gray-600',
                          date.isSelected ? 'bg-blue-500 text-white' : '',
                          date.isToday ? 'bg-gray-600 text-white' : ''
                        ]"
                      >
                        {{ date.day }}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div>
              <p class="text-gray-400 text-xs mb-1">Tags</p>
              <div class="flex gap-1 flex-wrap">
                <button 
                  @click="selectTag('all')" 
                  :class="[
                    'text-xs px-2 py-1 rounded-sm transition-colors cursor-pointer',
                    selectedTag === 'all' 
                      ? 'bg-blue-500 text-white' 
                      : 'bg-gray-600 text-gray-300 hover:bg-gray-500'
                  ]"
                >
                  All
                </button>
                <button 
                  @click="selectTag('orange')" 
                  :class="[
                    'text-xs px-2 py-1 rounded-sm transition-colors cursor-pointer',
                    selectedTag === 'orange' 
                      ? 'bg-orange-500 text-white' 
                      : 'bg-orange-500/50 text-orange-300 hover:bg-orange-500/70'
                  ]"
                >
                  Research
                </button>
                <button 
                  @click="selectTag('teal')" 
                  :class="[
                    'text-xs px-2 py-1 rounded-sm transition-colors cursor-pointer',
                    selectedTag === 'teal' 
                      ? 'bg-teal-500 text-white' 
                      : 'bg-teal-500/50 text-teal-300 hover:bg-teal-500/70'
                  ]"
                >
                  Design
                </button>
                <button 
                  @click="selectTag('purple')" 
                  :class="[
                    'text-xs px-2 py-1 rounded-sm transition-colors cursor-pointer',
                    selectedTag === 'purple' 
                      ? 'bg-purple-500 text-white' 
                      : 'bg-purple-500/50 text-purple-300 hover:bg-purple-500/70'
                  ]"
                >
                  Development
                </button>
                <button 
                  @click="selectTag('gray')" 
                  :class="[
                    'text-xs px-2 py-1 rounded-sm transition-colors cursor-pointer',
                    selectedTag === 'gray' 
                      ? 'bg-gray-600 text-white' 
                      : 'bg-gray-600/50 text-gray-300 hover:bg-gray-600/70'
                  ]"
                >
                  Other
                </button>
              </div>
            </div>
          </div>
          
          <!-- Right side: Members -->
          <div>
            <div class="flex items-center gap-3">
              <!-- Member Count Circle -->
              <div class="w-6 h-6  border-2 border-gray-300 rounded-full flex items-center justify-center">
                <span class="text-gray-700 text-white text-xs font-medium">4</span>
              </div>
              
              <!-- Members Label -->
              <span class="text-gray-400 text-sm">Members:</span>
              
              <!-- Member Avatars -->
              <div class="flex -space-x-2">
                <div class="w-8 h-8 bg-blue-400 rounded-full border-2 border-gray-800 flex items-center justify-center">
                  <span class="text-white text-xs font-medium">JD</span>
                </div>
                <div class="w-8 h-8 bg-green-400 rounded-full border-2 border-gray-800 flex items-center justify-center">
                  <span class="text-white text-xs font-medium">SM</span>
                </div>
                <div class="w-8 h-8 bg-purple-400 rounded-full border-2 border-gray-800 flex items-center justify-center">
                  <span class="text-white text-xs font-medium">MJ</span>
                </div>
                <div class="w-8 h-8 bg-pink-400 rounded-full border-2 border-gray-800 flex items-center justify-center">
                  <span class="text-white text-xs font-medium">RK</span>
                </div>
              </div>
              
              <!-- Invite Member Button -->
              <button class="bg-gray-700 hover:bg-gray-600 text-white text-sm px-3 py-1 rounded-2xl transition-colors">
                Invite member
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Task Management Header Bar -->
    <div class=" p-6">
      <div class="flex justify-between items-center">
        <!-- Left Side: Task Count and Add New Button -->
        <div class="flex items-center gap-4">
          <span class="text-white text-lg font-medium">{{ backlogCount + inProgressCount + doneCount + archivedCount }} tasks</span>
                      <button class="bg-blue-500 hover:bg-blue-400 text-white px-4 py-2 rounded-4xl flex items-center gap-2 transition-colors">
              <i class="bx bx-plus-circle text-xl"></i> 
              <span>Add New</span>
            </button>
        </div>
        
        <!-- Right Side: Search, Filters, Sort -->
        <div class="flex items-center gap-3">
          <!-- Search Bar -->
          <div class="relative">
            <input 
              type="text" 
              placeholder="Type to search..." 
              class="bg-gray-700 text-white placeholder-gray-400 px-4 py-2 pl-10 rounded-4xl focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
          </div>
          
          <!-- Filters Button -->
          <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-4xl flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            <span>Filters</span>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
          
          <!-- Sort Button -->
          <button class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-4xl flex items-center gap-2 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
            </svg>
            <span>Sort</span>
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
          </button>
        </div>
      </div>
    </div>
    
   
    <div class="min-h-screen  p-6 -m-6">
     
      <div class="flex gap-6 overflow-x-auto pb-6">
        
        <div class="flex-shrink-0 w-64">
          <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-700/50">
           
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center gap-2">
                <h3 class="text-white font-semibold">BACKLOG</h3>
                <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded-full">{{ backlogCount }}</span>
              </div>
              <div class="flex items-center gap-2">
                <button class="text-gray-400 hover:text-white transition-colors">
                  <i class="bx bx-dots-horizontal-rounded text-lg"></i>
                </button>
                <button class="text-gray-400 hover:text-white transition-colors">
                  <i class="bx bx-plus text-lg"></i>
                </button>
              </div>
            </div>

           
            <div class="space-y-3">
              <div 
                v-for="task in filteredBacklogTasks" 
                :key="task.id"
                :class="getTaskCardClass(task.dateColor)"
              >
                <div class="flex items-start justify-between mb-3">
                  <div class="flex items-center gap-2">
                    <i class="bx bx-calendar" :class="getTaskIconClass(task.dateColor)"></i>
                    <span :class="getTaskDateClass(task.dateColor)">{{ task.date }}</span>
                  </div>
                  <i class="bx bx-right-arrow-alt text-gray-400 text-sm"></i>
                </div>
                <h4 class="text-white font-medium mb-2">{{ task.title }}</h4>
                <div class="flex items-center justify-between">
                  <span :class="`${getPriorityBadgeClass(task.priority)} text-xs px-2 py-1 rounded-full`">{{ task.priority }} priority</span>
                  <div class="flex -space-x-2">
                    <div 
                      v-for="(member, index) in task.members" 
                      :key="member"
                      class="w-6 h-6 rounded-full border-2 border-gray-800 flex items-center justify-center"
                      :class="task.memberColors[index]"
                    >
                      <span class="text-white text-xs font-medium">{{ member }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- IN PROGRESS Column -->
        <div class="flex-shrink-0 w-64">
          <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-700/50">
            <!-- Column Header -->
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center gap-2">
                <h3 class="text-white font-semibold">IN PROGRESS</h3>
                <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded-full">{{ inProgressCount }}</span>
              </div>
              <div class="flex items-center gap-2">
                <button class="text-gray-400 hover:text-white transition-colors">
                  <i class="bx bx-dots-horizontal-rounded text-lg"></i>
                </button>
                <button class="text-gray-400 hover:text-white transition-colors">
                  <i class="bx bx-plus text-lg"></i>
                </button>
              </div>
            </div>

            <!-- Task Cards -->
            <div class="space-y-3">
              <div 
                v-for="task in filteredInProgressTasks" 
                :key="task.id"
                :class="getTaskCardClass(task.dateColor)"
              >
                <div class="flex items-start justify-between mb-3">
                  <div class="flex items-center gap-2">
                    <i class="bx bx-calendar" :class="getTaskIconClass(task.dateColor)"></i>
                    <span :class="getTaskDateClass(task.dateColor)">{{ task.date }}</span>
                  </div>
                  <i class="bx bx-right-arrow-alt text-gray-400 text-sm"></i>
                </div>
                <h4 class="text-white font-medium mb-2">{{ task.title }}</h4>
                <div class="flex items-center justify-between">
                  <span :class="`${getPriorityBadgeClass(task.priority)} text-xs px-2 py-1 rounded-full`">{{ task.priority }} priority</span>
                  <div class="flex -space-x-2">
                    <div 
                      v-for="(member, index) in task.members" 
                      :key="member"
                      class="w-6 h-6 rounded-full border-2 border-gray-800 flex items-center justify-center"
                      :class="task.memberColors[index]"
                    >
                      <span class="text-white text-xs font-medium">{{ member }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- DONE Column -->
        <div class="flex-shrink-0 w-64">
          <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-700/50">
            <!-- Column Header -->
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center gap-2">
                <i class="bx bx-check-circle text-green-400 text-lg"></i>
                <h3 class="text-white font-semibold">DONE</h3>
                <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded-full">{{ doneCount }}</span>
              </div>
              <div class="flex items-center gap-2">
                <button class="text-gray-400 hover:text-white transition-colors">
                  <i class="bx bx-dots-horizontal-rounded text-lg"></i>
                </button>
                <button class="text-gray-400 hover:text-white transition-colors">
                  <i class="bx bx-plus text-lg"></i>
                </button>
              </div>
            </div>

            <!-- Task Cards -->
            <div class="space-y-3">
              <div 
                v-for="task in filteredDoneTasks" 
                :key="task.id"
                :class="getTaskCardClass(task.dateColor)"
              >
                <div class="flex items-start justify-between mb-3">
                  <div class="flex items-center gap-2">
                    <i class="bx bx-calendar" :class="getTaskIconClass(task.dateColor)"></i>
                    <span :class="getTaskDateClass(task.dateColor)">{{ task.date }}</span>
                  </div>
                  <i class="bx bx-right-arrow-alt text-gray-400 text-sm"></i>
                </div>
                <h4 class="text-white font-medium mb-2">{{ task.title }}</h4>
                <div class="flex items-center justify-between">
                  <span :class="`${getPriorityBadgeClass(task.priority)} text-xs px-2 py-1 rounded-full`">{{ task.priority }} priority</span>
                  <div class="flex -space-x-2">
                    <div 
                      v-for="(member, index) in task.members" 
                      :key="member"
                      class="w-6 h-6 rounded-full border-2 border-gray-800 flex items-center justify-center"
                      :class="task.memberColors[index]"
                    >
                      <span class="text-white text-xs font-medium">{{ member }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- ARCHIVED Column -->
        <div class="flex-shrink-0 w-64">
          <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-700/50">
            <!-- Column Header -->
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center gap-2">
                <i class="bx bx-trash text-red-400 text-lg"></i>
                <h3 class="text-white font-semibold">ARCHIVED</h3>
                <span class="bg-gray-700 text-gray-300 text-xs px-2 py-1 rounded-full">{{ archivedCount }}</span>
              </div>
              <div class="flex items-center gap-2">
                <button class="text-gray-400 hover:text-white transition-colors">
                  <i class="bx bx-dots-horizontal-rounded text-lg"></i>
                </button>
                <button class="text-gray-400 hover:text-white transition-colors">
                  <i class="bx bx-plus text-lg"></i>
                </button>
              </div>
            </div>

            <!-- Task Cards -->
            <div class="space-y-3">
              <div 
                v-for="task in filteredArchivedTasks" 
                :key="task.id"
                :class="getTaskCardClass(task.dateColor)"
              >
                <div class="flex items-start justify-between mb-3">
                  <div class="flex items-center gap-2">
                    <i class="bx bx-calendar" :class="getTaskIconClass(task.dateColor)"></i>
                    <span :class="getTaskDateClass(task.dateColor)">{{ task.date }}</span>
                  </div>
                  <i class="bx bx-right-arrow-alt text-gray-400 text-sm"></i>
                </div>
                <h4 class="text-white font-medium mb-2">{{ task.title }}</h4>
                <div class="flex items-center justify-between">
                  <span :class="`${getPriorityBadgeClass(task.priority)} text-xs px-2 py-1 rounded-full`">{{ task.priority }} priority</span>
                  <div class="flex -space-x-2">
                    <div 
                      v-for="(member, index) in task.members" 
                      :key="member"
                      class="w-6 h-6 rounded-full border-2 border-gray-800 flex items-center justify-center"
                      :class="task.memberColors[index]"
                    >
                      <span class="text-white text-xs font-medium">{{ member }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Fifth Column (Empty/Add New) -->
        <div class="flex-shrink-0 w-64">
          <div class="bg-gray-800/50 backdrop-blur-sm rounded-2xl p-4 border border-gray-700/50">
            <!-- Column Header -->
            <div class="flex items-center justify-between mb-4">
              <div class="flex items-center gap-2">
                <!-- Empty header space -->
              </div>
              <div class="flex items-center gap-2">
                <button class="text-gray-400 hover:text-white transition-colors">
                  <i class="bx bx-dots-horizontal-rounded text-lg"></i>
                </button>
                <button class="text-gray-400 hover:text-white transition-colors">
                  <i class="bx bx-plus text-lg"></i>
                </button>
              </div>
            </div>

            <!-- Empty column content -->
            <div class="min-h-[200px]"></div>
          </div>
        </div>
      </div>
    </div>



    <!-- Floating Action Button with Dropdown -->
    <div class="fixed bottom-6 right-6 z-50">
      <!-- Dropdown Menu -->
      <div v-if="showDropdown" class="absolute bottom-16 right-0 mb-2 bg-[#564b5b]/90 backdrop-blur-sm rounded-xl border border-gray-700/50 shadow-lg min-w-[200px]">
        <div class="p-2">
          <button class="w-full flex items-center gap-3 px-4 py-3 text-white hover:bg-gray-700/50 rounded-lg transition-colors">
            <i class="bx bx-folder-plus text-lg"></i>
            <span>New Project</span>
          </button>
          <div class="border-t border-gray-500 my-1"></div>
          <button class="w-full flex items-center gap-3 px-4 py-3 text-white hover:bg-gray-700/50 rounded-lg transition-colors">
            <i class="bx bx-task text-lg"></i>
            <span>Create Task</span>
          </button>
          <div class="border-t border-gray-500 my-1"></div>
          <button class="w-full flex items-center gap-3 px-4 py-3 text-white hover:bg-gray-700/50 rounded-lg transition-colors">
            <i class="bx bx-user-plus text-lg"></i>
            <span>Invite Member</span>
          </button>
        </div>
      </div>

      <!-- Floating Action Button -->
      <button 
        @click="toggleDropdown"
        class="w-10 h-10 bg-blue-500 border-2 border-white hover:bg-blue-400 rounded-full shadow-lg flex items-center justify-center transition-all duration-200 hover:scale-105"
      >
        <i class="bx bx-plus text-white text-2xl"></i>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'

const emit = defineEmits(['section-change'])

const showDropdown = ref(false)
const showProjectDropdown = ref(false)
const showPriorityDropdown = ref(false)
const showStartDatePicker = ref(false)
const showDueDatePicker = ref(false)
const currentProjectTitle = ref('Software Projects')
const selectedPriority = ref('All')
const selectedTag = ref('all') // Track selected tag for filtering
const selectedStartDate = ref(new Date(2025, 0, 1)) // Jan 01, 2025
const selectedDueDate = ref(new Date(2025, 11, 31)) // Dec 31, 2025
const currentDate = ref(new Date())
const currentDueDate = ref(new Date())

const projectList = ref([
  { name: 'Software Projects', type: 'software' },
  { name: 'IT Projects', type: 'it' },
  { name: 'Web Projects', type: 'web' }
])

const priorityOptions = ref(['All', 'High', 'Medium', 'Low'])

// Task data with priority information and date ranges
const allTasks = ref({
  backlog: [
    {
      id: 1,
      title: 'Design user authentication system',
      priority: 'High',
      date: 'Jan 15, 2025',
      dateColor: 'teal', // Design - teal color
      members: ['JD', 'SM'],
      memberColors: ['blue-400', 'green-400'],
      startDate: '2025-01-01',
      dueDate: '2025-01-15'
    },
    {
      id: 2,
      title: 'Implement database schema',
      priority: 'Low',
      date: 'Jan 31, 2025',
      dateColor: 'purple', // Development - purple color
      members: ['SM'],
      memberColors: ['green-400'],
      startDate: '2025-01-16',
      dueDate: '2025-01-31'
    },
    {
      id: 3,
      title: 'Create API documentation',
      priority: 'Medium',
      date: 'Feb 15, 2025',
      dateColor: 'purple', // Development - purple color
      members: ['JD'],
      memberColors: ['blue-400'],
      startDate: '2025-02-01',
      dueDate: '2025-02-15'
    },
    {
      id: 4,
      title: 'Setup development environment',
      priority: 'High',
      date: 'Mar 01, 2025',
      dateColor: 'purple', // Development - purple color
      members: ['JD', 'SM', 'MJ'],
      memberColors: ['blue-400', 'green-400', 'purple-400'],
      startDate: '2025-02-16',
      dueDate: '2025-03-01'
    },
    {
      id: 5,
      title: 'Plan project architecture',
      priority: 'Medium',
      date: 'Mar 15, 2025',
      dateColor: 'teal', // Design - teal color
      members: ['JD'],
      memberColors: ['blue-400'],
      startDate: '2025-03-02',
      dueDate: '2025-03-15'
    },
    {
      id: 6,
      title: 'Research third-party integrations',
      priority: 'Low',
      date: 'Mar 31, 2025',
      dateColor: 'orange', // Research - orange color
      members: ['SM'],
      memberColors: ['green-400'],
      startDate: '2025-03-16',
      dueDate: '2025-03-31'
    },
    {
      id: 7,
      title: 'Define coding standards',
      priority: 'High',
      date: 'Apr 15, 2025',
      dateColor: 'gray', // Other - gray color
      members: ['JD', 'RK'],
      memberColors: ['blue-400', 'pink-400'],
      startDate: '2025-04-01',
      dueDate: '2025-04-15'
    },
    {
      id: 8,
      title: 'Create project timeline',
      priority: 'Medium',
      date: 'Apr 30, 2025',
      dateColor: 'gray', // Other - gray color
      members: ['MJ'],
      memberColors: ['purple-400'],
      startDate: '2025-04-16',
      dueDate: '2025-04-30'
    }
  ],
  inProgress: [
    {
      id: 9,
      title: 'Develop core modules',
      priority: 'Low',
      date: 'May 15, 2025',
      dateColor: 'purple', // Development - purple color
      members: ['SM'],
      memberColors: ['green-400'],
      startDate: '2025-05-01',
      dueDate: '2025-05-15'
    },
    {
      id: 10,
      title: 'Unit testing implementation',
      priority: 'High',
      date: 'May 31, 2025',
      dateColor: 'purple', // Development - purple color
      members: ['JD'],
      memberColors: ['blue-400'],
      startDate: '2025-05-16',
      dueDate: '2025-05-31'
    },
    {
      id: 11,
      title: 'Database optimization',
      priority: 'Medium',
      date: 'Jun 15, 2025',
      dateColor: 'purple', // Development - purple color
      members: ['SM', 'MJ'],
      memberColors: ['green-400', 'purple-400'],
      startDate: '2025-06-01',
      dueDate: '2025-06-15'
    },
    {
      id: 12,
      title: 'Security implementation',
      priority: 'High',
      date: 'Jun 30, 2025',
      dateColor: 'purple', // Development - purple color
      members: ['JD', 'RK'],
      memberColors: ['blue-400', 'pink-400'],
      startDate: '2025-06-16',
      dueDate: '2025-06-30'
    },
    {
      id: 13,
      title: 'Performance monitoring setup',
      priority: 'Low',
      date: 'Jul 15, 2025',
      dateColor: 'gray', // Other - gray color
      members: ['SM'],
      memberColors: ['green-400'],
      startDate: '2025-07-01',
      dueDate: '2025-07-15'
    }
  ],
  done: [
    {
      id: 14,
      title: 'Project setup and configuration',
      priority: 'High',
      date: 'Jul 31, 2025',
      dateColor: 'purple', // Development - purple color
      members: ['SM'],
      memberColors: ['green-400'],
      startDate: '2025-07-16',
      dueDate: '2025-07-31'
    },
    {
      id: 15,
      title: 'Requirements gathering',
      priority: 'High',
      date: 'Aug 15, 2025',
      dateColor: 'teal', // Design - teal color
      members: ['JD'],
      memberColors: ['blue-400'],
      startDate: '2025-08-01',
      dueDate: '2025-08-15'
    },
    {
      id: 16,
      title: 'Team onboarding',
      priority: 'Medium',
      date: 'Aug 31, 2025',
      dateColor: 'gray', // Other - gray color
      members: ['MJ'],
      memberColors: ['purple-400'],
      startDate: '2025-08-16',
      dueDate: '2025-08-31'
    }
  ],
  archived: [
    {
      id: 17,
      title: 'Initial planning phase',
      priority: 'Low',
      date: 'Sep 15, 2025',
      dateColor: 'teal', // Design - teal color
      members: ['JD'],
      memberColors: ['blue-400'],
      startDate: '2025-09-01',
      dueDate: '2025-09-15'
    },
    {
      id: 18,
      title: 'Market research',
      priority: 'Medium',
      date: 'Sep 30, 2025',
      dateColor: 'orange', // Research - orange color
      members: ['SM'],
      memberColors: ['green-400'],
      startDate: '2025-09-16',
      dueDate: '2025-09-30'
    }
  ]
})



// Helper function to check if a task falls within the selected date range
const isTaskInDateRange = (task) => {
  // If task doesn't have startDate or dueDate, include it
  if (!task.startDate && !task.dueDate) {
    return true
  }
  
  const startDate = selectedStartDate.value
  const dueDate = selectedDueDate.value
  
  // Convert task dates to Date objects for comparison
  const taskStartDate = task.startDate ? new Date(task.startDate) : null
  const taskDueDate = task.dueDate ? new Date(task.dueDate) : null
  
  // If task has both start and due dates
  if (taskStartDate && taskDueDate) {
    // Task should start within or before the selected range and end within or after the selected range
    return taskStartDate <= dueDate && taskDueDate >= startDate
  }
  
  // If task only has start date
  if (taskStartDate && !taskDueDate) {
    return taskStartDate >= startDate && taskStartDate <= dueDate
  }
  
  // If task only has due date
  if (!taskStartDate && taskDueDate) {
    return taskDueDate >= startDate && taskDueDate <= dueDate
  }
  
  return true
}

// Computed properties to filter tasks based on selected priority, tag, and date range
const filteredBacklogTasks = computed(() => {
  let filtered = allTasks.value.backlog
  
  // Filter by priority
  if (selectedPriority.value !== 'All') {
    filtered = filtered.filter(task => task.priority === selectedPriority.value)
  }
  
  // Filter by tag
  if (selectedTag.value !== 'all') {
    filtered = filtered.filter(task => task.dateColor === selectedTag.value)
  }
  
  // Filter by date range
  filtered = filtered.filter(task => isTaskInDateRange(task))
  
  return filtered
})

const filteredInProgressTasks = computed(() => {
  let filtered = allTasks.value.inProgress
  
  // Filter by priority
  if (selectedPriority.value !== 'All') {
    filtered = filtered.filter(task => task.priority === selectedPriority.value)
  }
  
  // Filter by tag
  if (selectedTag.value !== 'all') {
    filtered = filtered.filter(task => task.dateColor === selectedTag.value)
  }
  
  // Filter by date range
  filtered = filtered.filter(task => isTaskInDateRange(task))
  
  return filtered
})

const filteredDoneTasks = computed(() => {
  let filtered = allTasks.value.done
  
  // Filter by priority
  if (selectedPriority.value !== 'All') {
    filtered = filtered.filter(task => task.priority === selectedPriority.value)
  }
  
  // Filter by tag
  if (selectedTag.value !== 'all') {
    filtered = filtered.filter(task => task.dateColor === selectedTag.value)
  }
  
  // Filter by date range
  filtered = filtered.filter(task => isTaskInDateRange(task))
  
  return filtered
})

const filteredArchivedTasks = computed(() => {
  let filtered = allTasks.value.archived
  
  // Filter by priority
  if (selectedPriority.value !== 'All') {
    filtered = filtered.filter(task => task.priority === selectedPriority.value)
  }
  
  // Filter by tag
  if (selectedTag.value !== 'all') {
    filtered = filtered.filter(task => task.dateColor === selectedTag.value)
  }
  
  // Filter by date range
  filtered = filtered.filter(task => isTaskInDateRange(task))
  
  return filtered
})

// Computed properties for task counts
const backlogCount = computed(() => filteredBacklogTasks.value.length)
const inProgressCount = computed(() => filteredInProgressTasks.value.length)
const doneCount = computed(() => filteredDoneTasks.value.length)
const archivedCount = computed(() => filteredArchivedTasks.value.length)

const toggleDropdown = () => {
  showDropdown.value = !showDropdown.value
}

const toggleProjectDropdown = () => {
  showProjectDropdown.value = !showProjectDropdown.value
}

const changeProject = (projectType) => {
  showProjectDropdown.value = false
  switch(projectType) {
    case 'software':
      emit('section-change', 'software-projects')
      break
    case 'it':
      emit('section-change', 'it-projects')
      break
    case 'web':
      emit('section-change', 'web-projects')
      break
  }
}

const getProjectIconClass = (type) => {
  switch (type) {
    case 'software':
      return 'bg-blue-500 text-white'
    case 'web':
      return 'bg-orange-500 text-white'
    case 'it':
      return 'bg-yellow-500 text-white'
    default:
      return 'bg-gray-500 text-white'
  }
}

const togglePriorityDropdown = () => {
  showPriorityDropdown.value = !showPriorityDropdown.value
}

const changePriority = (priority) => {
  selectedPriority.value = priority
  showPriorityDropdown.value = false
}

const selectTag = (tag) => {
  selectedTag.value = tag
}

const getPriorityColorClass = (priority) => {
  switch (priority) {
    case 'All':
      return 'text-blue-400'
    case 'High':
      return 'text-red-400'
    case 'Medium':
      return 'text-yellow-400'
    case 'Low':
      return 'text-green-400'
    default:
      return 'text-gray-400'
  }
}

const getPriorityBadgeClass = (priority) => {
  switch (priority) {
    case 'High':
      return 'bg-red-500/20 text-red-400'
    case 'Medium':
      return 'bg-yellow-500/20 text-yellow-400'
    case 'Low':
      return 'bg-green-500/20 text-green-400'
    default:
      return 'bg-gray-500/20 text-gray-400'
  }
}

const goToAllProjects = () => {
  console.log('goToAllProjects clicked')
  currentProjectTitle.value = 'Projects'
  emit('section-change', 'projects')
}

// Date picker functionality
const currentMonthYear = computed(() => {
  return currentDate.value.toLocaleDateString('en-US', { month: 'long', year: 'numeric' })
})

const currentDueMonthYear = computed(() => {
  return currentDueDate.value.toLocaleDateString('en-US', { month: 'long', year: 'numeric' })
})

const calendarDates = computed(() => {
  const year = currentDate.value.getFullYear()
  const month = currentDate.value.getMonth()
  
  const firstDay = new Date(year, month, 1)
  const lastDay = new Date(year, month + 1, 0)
  const startDate = new Date(firstDay)
  startDate.setDate(startDate.getDate() - firstDay.getDay())
  
  const dates = []
  const today = new Date()
  
  for (let i = 0; i < 42; i++) {
    const date = new Date(startDate)
    date.setDate(startDate.getDate() + i)
    
    dates.push({
      key: date.toISOString(),
      day: date.getDate(),
      date: date,
      isCurrentMonth: date.getMonth() === month,
      isSelected: date.toDateString() === selectedStartDate.value.toDateString(),
      isToday: date.toDateString() === today.toDateString()
    })
  }
  
  return dates
})

const dueCalendarDates = computed(() => {
  const year = currentDueDate.value.getFullYear()
  const month = currentDueDate.value.getMonth()
  
  const firstDay = new Date(year, month, 1)
  const lastDay = new Date(year, month + 1, 0)
  const startDate = new Date(firstDay)
  startDate.setDate(startDate.getDate() - firstDay.getDay())
  
  const dates = []
  const today = new Date()
  
  for (let i = 0; i < 42; i++) {
    const date = new Date(startDate)
    date.setDate(startDate.getDate() + i)
    
    dates.push({
      key: date.toISOString(),
      day: date.getDate(),
      date: date,
      isCurrentMonth: date.getMonth() === month,
      isSelected: date.toDateString() === selectedDueDate.value.toDateString(),
      isToday: date.toDateString() === today.toDateString()
    })
  }
  
  return dates
})

const toggleStartDatePicker = (event) => {
  event.stopPropagation()
  showStartDatePicker.value = !showStartDatePicker.value
  if (showDueDatePicker.value) {
    showDueDatePicker.value = false
  }
}

const toggleDueDatePicker = (event) => {
  event.stopPropagation()
  showDueDatePicker.value = !showDueDatePicker.value
  if (showStartDatePicker.value) {
    showStartDatePicker.value = false
  }
}

const selectStartDate = (dateObj) => {
  selectedStartDate.value = dateObj.date
  showStartDatePicker.value = false
}

const selectDueDate = (dateObj) => {
  selectedDueDate.value = dateObj.date
  showDueDatePicker.value = false
}

const previousMonth = () => {
  currentDate.value = new Date(currentDate.value.getFullYear(), currentDate.value.getMonth() - 1, 1)
}

const nextMonth = () => {
  currentDate.value = new Date(currentDate.value.getFullYear(), currentDate.value.getMonth() + 1, 1)
}

const previousDueMonth = () => {
  currentDueDate.value = new Date(currentDueDate.value.getFullYear(), currentDueDate.value.getMonth() - 1, 1)
}

const nextDueMonth = () => {
  currentDueDate.value = new Date(currentDueDate.value.getFullYear(), currentDueDate.value.getMonth() + 1, 1)
}

const formatDate = (date) => {
  return date.toLocaleDateString('en-US', { 
    month: 'short', 
    day: '2-digit', 
    year: 'numeric' 
  })
}

// Task card styling methods
const getTaskCardClass = (dateColor) => {
  switch (dateColor) {
    case 'orange': // Research
      return 'bg-orange-500/20 border border-orange-500/30 rounded-xl p-4 cursor-pointer hover:bg-orange-500/30 transition-all'
    case 'teal': // Design
      return 'bg-teal-500/20 border border-teal-500/30 rounded-xl p-4 cursor-pointer hover:bg-teal-500/30 transition-all'
    case 'purple': // Development
      return 'bg-purple-500/20 border border-purple-500/30 rounded-xl p-4 cursor-pointer hover:bg-purple-500/30 transition-all'
    case 'gray': // Other
      return 'bg-gray-500/20 border border-gray-500/30 rounded-xl p-4 cursor-pointer hover:bg-gray-500/30 transition-all'
    default:
      return 'bg-gray-500/20 border border-gray-500/30 rounded-xl p-4 cursor-pointer hover:bg-gray-500/30 transition-all'
  }
}

const getTaskIconClass = (dateColor) => {
  switch (dateColor) {
    case 'orange': // Research
      return 'text-orange-400 text-sm'
    case 'teal': // Design
      return 'text-teal-400 text-sm'
    case 'purple': // Development
      return 'text-purple-400 text-sm'
    case 'gray': // Other
      return 'text-gray-400 text-sm'
    default:
      return 'text-gray-400 text-sm'
  }
}

const getTaskDateClass = (dateColor) => {
  switch (dateColor) {
    case 'orange': // Research
      return 'text-orange-300 text-sm'
    case 'teal': // Design
      return 'text-teal-300 text-sm'
    case 'purple': // Development
      return 'text-purple-300 text-sm'
    case 'gray': // Other
      return 'text-gray-300 text-sm'
    default:
      return 'text-gray-300 text-sm'
  }
}

// Close dropdown when clicking outside
const closeDropdown = (event) => {
  if (!event.target.closest('.fixed.bottom-6.right-6')) {
    showDropdown.value = false
  }
  if (!event.target.closest('.relative')) {
    showProjectDropdown.value = false
    showPriorityDropdown.value = false
  }
  
  // Close start date picker if clicking outside of it and its button
  if (showStartDatePicker.value && 
      !event.target.closest('[data-date-picker="start"]') && 
      !event.target.closest('[data-date-button="start"]')) {
    showStartDatePicker.value = false
  }
  
  // Close due date picker if clicking outside of it and its button
  if (showDueDatePicker.value && 
      !event.target.closest('[data-date-picker="due"]') && 
      !event.target.closest('[data-date-button="due"]')) {
    showDueDatePicker.value = false
  }
}

// Add click outside listener
onMounted(() => {
  document.addEventListener('click', closeDropdown)
})

onUnmounted(() => {
  document.removeEventListener('click', closeDropdown)
})
</script> 