<template>
  <div class="min-h-screen  text-white">
    <div class="bg-black rounded-3xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
      <!-- Blue gradient header section -->
      <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-8 ">
        <div class="flex justify-between items-start">
          <div >
            <nav class="flex items-center space-x-2 text-sm text-blue-100 mb-1">
              <a href="#" @click.prevent="goToAllProjects" class="hover:text-white transition-colors">Projects</a>
            </nav>
                        <div class="flex items-center gap-4">
              <h2 class="text-3xl font-bold text-white">{{ currentProjectTitle }}</h2>
            </div>
          </div>
          
        </div>
      </div>
      <!-- Dark gray details section -->
      
    </div>


    <!-- Search and Filter Bar -->
    <div class="mb-2 flex gap-2 p-6">
      <div class="flex-1 relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </div>
        <input
          v-model="searchQuery"
          type="text"
          placeholder="Search projects"
          class="w-full pl-10 pr-4 py-2 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-white placeholder-gray-400"
        />
      </div>
      <div class="relative">
        <select
          v-model="selectedFilter"
          class="appearance-none bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 pr-8 text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        >
          <option value="">Filter by product</option>
          <option value="software">Software</option>
          <option value="web">Web</option>
          <option value="it">IT</option>
        </select>
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
          </svg>
        </div>
      </div>
      <button 
        @click="toggleStarFilter"
        :class="[
          'px-4 py-2 rounded-lg border transition-colors flex items-center gap-2',
          showStarredOnly 
            ? 'bg-yellow-500 border-yellow-500 text-white hover:bg-yellow-600' 
            : 'bg-gray-800 border-gray-700 text-gray-300 hover:bg-gray-700 hover:text-white'
        ]"
      >
        <svg class="h-5 w-5" :class="showStarredOnly ? 'text-white' : 'text-gray-400'" fill="currentColor" viewBox="0 0 24 24">
          <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
        </svg>
        <span>{{ showStarredOnly ? 'Show All' : 'Show Starred' }}</span>
      </button>
    </div>

    <!-- Projects Table -->
    <div class="bg-gray-800 rounded-lg overflow-hidden p-6">
      <table class="w-full">
        <thead class="bg-gray-700">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
              <div class="flex items-center gap-2">
                <button 
                  @click="toggleStarAll"
                  class="hover:scale-110 transition-transform"
                  :title="allStarred ? 'Unstar All' : 'Star All'"
                >
                  <svg class="h-4 w-4" :class="allStarred ? 'text-yellow-400 fill-current' : 'text-gray-400'" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                  </svg>
                </button>
                <span @click="sortBy('name')" class="cursor-pointer hover:text-white">Name</span>
                <svg @click="sortBy('name')" class="h-4 w-4 cursor-pointer" :class="getSortIconClass('name')" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                </svg>
              </div>
            </th>
            <th @click="sortBy('key')" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider cursor-pointer hover:text-white">
              <div class="flex items-center gap-2">
                Key
                <svg class="h-4 w-4" :class="getSortIconClass('key')" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                </svg>
              </div>
            </th>
            <th @click="sortBy('type')" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider cursor-pointer hover:text-white">
              <div class="flex items-center gap-2">
                Type
                <svg class="h-4 w-4" :class="getSortIconClass('type')" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                </svg>
              </div>
            </th>
            <th @click="sortBy('lead')" class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider cursor-pointer hover:text-white">
              <div class="flex items-center gap-2">
                Lead
                <svg class="h-4 w-4" :class="getSortIconClass('lead')" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"></path>
                </svg>
              </div>
            </th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Project URL</th>
          </tr>
        </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
          <tr v-for="project in filteredProjects" :key="project.id" class="hover:bg-gray-700 transition-colors">
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center gap-3">
                <button 
                  @click.stop="toggleStar(project.id)"
                  class="flex-shrink-0 hover:scale-110 transition-transform"
                >
                  <svg class="h-4 w-4" :class="project.starred ? 'text-yellow-400 fill-current' : 'text-gray-400'" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                  </svg>
                </button>
                                 <div class="flex items-center gap-2 cursor-pointer" @click="goToProject(project.type)">
                   <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded flex items-center justify-center" :class="getProjectIconClass(project.type)">
                      <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24">
                        <path v-if="project.type === 'software'" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        <path v-else-if="project.type === 'web'" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        <path v-else d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                      </svg>
                    </div>
                    <span class="text-blue-400 font-medium">{{ project.name }}</span>
                  </div>
                </div>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ project.key }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ project.typeName }}</td>
            <td class="px-6 py-4 whitespace-nowrap">
              <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-purple-600 rounded-full flex items-center justify-center">
                  <span class="text-white text-sm font-medium">{{ project.lead.initials }}</span>
                </div>
                <span class="text-sm text-gray-300">{{ project.lead.name }}</span>
              </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">...</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
      <nav class="flex items-center gap-2">
        <button class="p-2 text-gray-400 hover:text-white disabled:opacity-50 disabled:cursor-not-allowed">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
          </svg>
        </button>
        <button class="px-3 py-2 bg-blue-600 text-white rounded font-medium">1</button>
        <button class="p-2 text-gray-400 hover:text-white">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </button>
      </nav>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const emit = defineEmits(['section-change'])

const currentProjectTitle = ref('Projects')

const searchQuery = ref('')

const goToProject = (projectType) => {
  console.log('Project clicked:', projectType)
  switch(projectType) {
    case 'software':
      console.log('Navigating to software-projects')
      emit('section-change', 'software-projects')
      break
    case 'it':
      console.log('Navigating to it-projects')
      emit('section-change', 'it-projects')
      break
    case 'web':
      console.log('Navigating to web-projects')
      emit('section-change', 'web-projects')
      break
    default:
      console.log('Unknown project type:', projectType)
  }
}


const selectedFilter = ref('')

// Sorting state
const sortField = ref('name')
const sortDirection = ref('asc')

// Star filter state
const showStarredOnly = ref(false)

// Computed property to check if all visible projects are starred
const allStarred = computed(() => {
  return filteredProjects.value.length > 0 && filteredProjects.value.every(project => project.starred)
})

const projects = ref([
  {
    id: 1,
    name: 'Software Projects',
    key: 'SP',
    type: 'software',
    typeName: 'Company-managed software',
    starred: false,
    lead: {
      name: 'Sam Matrouh',
      initials: 'SM'
    }
  },
  {
    id: 2,
    name: 'IT Projects',
    key: 'IT',
    type: 'it',
    typeName: 'Service management',
    starred: false,
    lead: {
      name: 'Sam Matrouh',
      initials: 'SM'
    }
  },
  {
    id: 3,
    name: 'Web Projects',
    key: 'WP',
    type: 'web',
    typeName: 'Web development',
    starred: false,
    lead: {
      name: 'Sam Matrouh',
      initials: 'SM'
    }
  }
])

const filteredProjects = computed(() => {
  let filtered = projects.value

  if (searchQuery.value) {
    filtered = filtered.filter(project => 
      project.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
      project.key.toLowerCase().includes(searchQuery.value.toLowerCase())
    )
  }

  if (selectedFilter.value) {
    filtered = filtered.filter(project => project.type === selectedFilter.value)
  }

  // Apply star filter
  if (showStarredOnly.value) {
    filtered = filtered.filter(project => project.starred)
  }

  // Apply sorting
  filtered = [...filtered].sort((a, b) => {
    let aValue, bValue
    
    switch (sortField.value) {
      case 'name':
        aValue = a.name.toLowerCase()
        bValue = b.name.toLowerCase()
        break
      case 'key':
        aValue = a.key.toLowerCase()
        bValue = b.key.toLowerCase()
        break
      case 'type':
        aValue = a.typeName.toLowerCase()
        bValue = b.typeName.toLowerCase()
        break
      case 'lead':
        aValue = a.lead.name.toLowerCase()
        bValue = b.lead.name.toLowerCase()
        break
      default:
        aValue = a.name.toLowerCase()
        bValue = b.name.toLowerCase()
    }
    
    if (sortDirection.value === 'asc') {
      return aValue.localeCompare(bValue)
    } else {
      return bValue.localeCompare(aValue)
    }
  })

  return filtered
})

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

// Sorting functions
const sortBy = (field) => {
  if (sortField.value === field) {
    // Toggle direction if same field
    sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc'
  } else {
    // Set new field with ascending default
    sortField.value = field
    sortDirection.value = 'asc'
  }
}

const getSortIconClass = (field) => {
  if (sortField.value !== field) {
    return 'text-gray-400'  // Inactive
  }
  return sortDirection.value === 'asc' ? 'text-blue-400' : 'text-blue-400 rotate-180'
}

// Star functions
const toggleStar = (projectId) => {
  const project = projects.value.find(p => p.id === projectId)
  if (project) {
    project.starred = !project.starred
  }
}

const toggleStarFilter = () => {
  showStarredOnly.value = !showStarredOnly.value
}

const toggleStarAll = () => {
  const shouldStar = !allStarred.value
  filteredProjects.value.forEach(project => {
    project.starred = shouldStar
  })
}

</script> 