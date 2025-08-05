<template>
  <div class="w-20 bg-gradient-to-b from-purple-900 to-black h-screen flex flex-col items-center py-6 fixed left-0 top-0">
    <!-- Logo -->
    <div class="mb-8">
      <div class="w-10 h-10 bg-gradient-to-br from-blue-400 via-pink-400 to-purple-400 rounded-lg flex items-center justify-center overflow-hidden">
        <img 
          src="/images/logo.png" 
          alt="Logo" 
          class="w-8 h-8 object-contain"
          @load="logoLoaded = true"
          @error="logoLoaded = false"
        />
        <span class="text-white font-bold text-lg" v-if="!logoLoaded">logo</span>
      </div>
    </div>

    <!-- Navigation Items -->
    <nav class="flex-1 flex flex-col justify-center space-y-6">
      <div
        v-for="item in navigationItems"
        :key="item.name"
        @click="selectSection(item.section)"
        :class="[
          'flex flex-col items-center cursor-pointer transition-all duration-200 relative',
          activeSection === item.section
            ? 'bg-purple-800/30 rounded-4xl p-3 mx-2'
            : 'hover:text-gray-300'
        ]"
      >
        <div 
          :class="[
            'w-8 h-8 flex items-center justify-center mb-1',
            activeSection === item.section ? 'text-white' : 'text-white'
          ]"
        >
          <i :class="item.icon" class="text-xl"></i>
        </div>
        <span 
          :class="[
            'text-xs font-medium',
            activeSection === item.section ? 'text-white' : 'text-white'
          ]"
        >
          {{ item.name }}
        </span>
      </div>
    </nav>

    <!-- User Avatar -->
    <div class="relative">
      <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-600 rounded-full flex items-center justify-center overflow-hidden">
        <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-600 flex items-center justify-center">
          <i class="bx bx-user text-white text-lg"></i>
        </div>
      </div>
      <!-- Notification Badge -->
      <div class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 rounded-full flex items-center justify-center">
        <span class="text-white text-xs font-bold">12</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const props = defineProps({
  activeSection: {
    type: String,
    default: 'dashboard'
  }
})

const emit = defineEmits(['section-change'])

const navigationItems = [
  { name: 'Home', icon: 'bx bx-home', section: 'home' },
  { name: 'Reports', icon: 'bx bx-bar-chart-alt-2', section: 'reports' },
  { name: 'Tasks', icon: 'bx bx-task', section: 'projects' },
  { name: 'Events', icon: 'bx bx-calendar', section: 'events' },
  { name: 'Deals', icon: 'bx bx-wallet-alt', section: 'deals' },
  { name: 'Users', icon: 'bx bx-group', section: 'users' }
]

const logoLoaded = ref(false)

const selectSection = (section) => {
  emit('section-change', section)
}
</script>
  