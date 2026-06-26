<style>
    :root {
        --primary-color: {{ config('branding.primary_color') }};
        --secondary-color: {{ config('branding.secondary_color') }};
        --text-color: {{ config('branding.text_color') }};
        --surface-color: {{ config('branding.surface_color') }};
        --accent-color: {{ config('branding.accent_color') }};
    }
</style>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    primary: 'var(--primary-color)',
                    secondary: 'var(--secondary-color)',
                    text: 'var(--text-color)',
                    surface: 'var(--surface-color)',
                    accent: 'var(--accent-color)',
                }
            }
        }
    }
</script>
