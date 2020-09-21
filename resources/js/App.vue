<template>
    <div>
        <Dashboard />
        <router-view></router-view>
    </div>
</template>
<script>
import Dashboard from "./components/Dashboard"
export default {
    components: {
        Dashboard
    }
}
</script>