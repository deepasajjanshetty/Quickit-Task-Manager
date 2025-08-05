<template>
  <div class="min-h-screen bg-black ">
    <!-- Sidebar -->
    <Sidebar @section-change="activeSection = $event" :active-section="activeSection" />
    
          <!-- Main Content -->
      <div class="ml-20 p-6 ">
        <!-- Dashboard Content -->
    
          

        <!-- Home Content -->
        <div v-if="activeSection === 'home'">
          <Home @section-change="activeSection = $event" />
        </div>

                            <!-- Projects Content -->
                    <div v-if="activeSection === 'projects'">
                      <Projects @section-change="activeSection = $event" />
                    </div>

                    <!-- Software Projects Content -->
                    <div v-if="activeSection === 'software-projects'">
                      <SoftwareProjects @section-change="activeSection = $event" />
                    </div>

                    <!-- IT Projects Content -->
                    <div v-if="activeSection === 'it-projects'">
                      <ITProjects @section-change="activeSection = $event" />
                    </div>

                    <!-- Web Projects Content -->
                    <div v-if="activeSection === 'web-projects'">
                      <WebProjects @section-change="activeSection = $event" />
                    </div>

      <!-- Reports Content -->
      <div v-if="activeSection === 'reports'">
        <Reports />
      </div>



      <!-- Events Content -->
      <div v-if="activeSection === 'events'">
        <Events />
      </div>

      <!-- Deals Content -->
      <div v-if="activeSection === 'deals'">
        <Deals />
      </div>

      <!-- Users Content -->
      <div v-if="activeSection === 'users'">
        <Users />
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import Sidebar from '../Components/Sidebar.vue'
import Home from './Home.vue'
import Projects from './Projects.vue'
import SoftwareProjects from './SoftwareProjects.vue'
import ITProjects from './ITProjects.vue'
import WebProjects from './WebProjects.vue'
import Reports from './Reports.vue'
import Events from './Events.vue'
import Deals from './Deals.vue'
import Users from './Users.vue'

const activeSection = ref('home')
</script> 