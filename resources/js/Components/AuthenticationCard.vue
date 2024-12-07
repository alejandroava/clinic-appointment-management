<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="text-center">
            <h1 class="text-4xl font-bold text-indigo-600">Clínica de Envigado</h1>
            <p class="text-lg mt-2 text-gray-600">Bienvenido al registro de pacientes</p>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>
