<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
		<script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
		<script type="text/javascript">
			window.tailwind.config = {
				darkMode: ['class'],
				theme: {
					extend: {
						colors: {
							border: 'hsl(var(--border))',
							input: 'hsl(var(--input))',
							ring: 'hsl(var(--ring))',
							background: 'hsl(var(--background))',
							foreground: 'hsl(var(--foreground))',
							primary: {
								DEFAULT: 'hsl(var(--primary))',
								foreground: 'hsl(var(--primary-foreground))'
							},
							secondary: {
								DEFAULT: 'hsl(var(--secondary))',
								foreground: 'hsl(var(--secondary-foreground))'
							},
							destructive: {
								DEFAULT: 'hsl(var(--destructive))',
								foreground: 'hsl(var(--destructive-foreground))'
							},
							muted: {
								DEFAULT: 'hsl(var(--muted))',
								foreground: 'hsl(var(--muted-foreground))'
							},
							accent: {
								DEFAULT: 'hsl(var(--accent))',
								foreground: 'hsl(var(--accent-foreground))'
							},
							popover: {
								DEFAULT: 'hsl(var(--popover))',
								foreground: 'hsl(var(--popover-foreground))'
							},
							card: {
								DEFAULT: 'hsl(var(--card))',
								foreground: 'hsl(var(--card-foreground))'
							},
						},
					}
				}
			}
		</script>
		<style type="text/tailwindcss">
			@layer base {
				:root {
					--background: 0 0% 100%;
--foreground: 240 10% 3.9%;
--card: 0 0% 100%;
--card-foreground: 240 10% 3.9%;
--popover: 0 0% 100%;
--popover-foreground: 240 10% 3.9%;
--primary: 240 5.9% 10%;
--primary-foreground: 0 0% 98%;
--secondary: 240 4.8% 95.9%;
--secondary-foreground: 240 5.9% 10%;
--muted: 240 4.8% 95.9%;
--muted-foreground: 240 3.8% 46.1%;
--accent: 240 4.8% 95.9%;
--accent-foreground: 240 5.9% 10%;
--destructive: 0 84.2% 60.2%;
--destructive-foreground: 0 0% 98%;
--border: 240 5.9% 90%;
--input: 240 5.9% 90%;
--ring: 240 5.9% 10%;
--radius: 0.5rem;
				}
				.dark {
					--background: 240 10% 3.9%;
--foreground: 0 0% 98%;
--card: 240 10% 3.9%;
--card-foreground: 0 0% 98%;
--popover: 240 10% 3.9%;
--popover-foreground: 0 0% 98%;
--primary: 0 0% 98%;
--primary-foreground: 240 5.9% 10%;
--secondary: 240 3.7% 15.9%;
--secondary-foreground: 0 0% 98%;
--muted: 240 3.7% 15.9%;
--muted-foreground: 240 5% 64.9%;
--accent: 240 3.7% 15.9%;
--accent-foreground: 0 0% 98%;
--destructive: 0 62.8% 30.6%;
--destructive-foreground: 0 0% 98%;
--border: 240 3.7% 15.9%;
--input: 240 3.7% 15.9%;
--ring: 240 4.9% 83.9%;
				}
			}
		</style>
  </head>
  <body>
    <div class="flex">
  <aside class="w-64 bg-zinc-800 text-white h-screen">
    <div class="p-4">
      <img src="https://placehold.co/150?text=Logo" alt="Logo" class="h-10 mb-4" />
      <h2 class="text-lg font-semibold">Responder Management</h2>
    </div>
    <nav class="mt-4">
      <ul>
        <li class="p-2 hover:bg-zinc-700"><a href="#">Add Responder</a></li>
        <li class="p-2 hover:bg-zinc-700"><a href="#">Remove Responder</a></li>
        <li class="p-2 hover:bg-zinc-700"><a href="#">Suspend Responder</a></li>
        <li class="p-2 hover:bg-zinc-700"><a href="#">Assign Tasks</a></li>
        <li class="p-2 hover:bg-zinc-700"><a href="#">Responder Locations</a></li>
      </ul>
    </nav>
    <div class="mt-auto p-2 hover:bg-zinc-700 cursor-pointer">LOG OUT</div>
  </aside>
  <main class="flex-1 bg-zinc-100 p-6">
    <h1 class="text-2xl font-bold">Responder Management</h1>
    <p class="text-zinc-600">Manage your responders efficiently</p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
      <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Total Responders</h2>
        <p class="text-3xl">00</p>
      </div>
      <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Active Responders</h2>
        <p class="text-3xl">00</p>
      </div>
      <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Suspended Responders</h2>
        <p class="text-3xl">00</p>
      </div>
      <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Tasks Assigned</h2>
        <p class="text-3xl">00</p>
      </div>
    </div>
    <h2 class="text-xl font-bold mt-8">Responder Tasks</h2>
    <p class="text-zinc-600">Assign tasks to your responders</p>
    <h2 class="text-xl font-bold mt-8">Responder Locations</h2>
    <p class="text-zinc-600">Track the locations of your responders</p>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
      <div class="bg-blue-200 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Task 1</h2>
        <p class="text-3xl">Responder Name</p>
      </div>
      <div class="bg-green-200 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Task 2</h2>
        <p class="text-3xl">Responder Name</p>
      </div>
      <div class="bg-zinc-200 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Task 3</h2>
        <p class="text-3xl">Responder Name</p>
      </div>
      <div class="bg-red-200 p-4 rounded-lg shadow">
        <h2 class="text-lg font-semibold">Task 4</h2>
        <p class="text-3xl">Responder Name</p>
      </div>
    </div>
  </main>
</div>

  </body>
</html>
</body>
</html>