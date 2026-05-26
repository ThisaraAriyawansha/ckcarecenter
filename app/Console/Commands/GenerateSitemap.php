<?php

namespace App\Console\Commands;

use App\Models\Blog;
use App\Models\Service;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap for the website';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating sitemap...');

        $sitemap = Sitemap::create();

        // Add static pages with priorities and change frequencies
        $staticPages = [
            // High priority pages
            ['url' => '/', 'priority' => 1.0, 'frequency' => 'daily'],
            ['url' => '/about/', 'priority' => 0.8, 'frequency' => 'weekly'],
            ['url' => '/services/', 'priority' => 0.8, 'frequency' => 'weekly'],
            ['url' => '/blog/', 'priority' => 0.8, 'frequency' => 'daily'],
            ['url' => '/packages/', 'priority' => 0.8, 'frequency' => 'weekly'],
            ['url' => '/we-care/', 'priority' => 0.8, 'frequency' => 'weekly'],
            ['url' => '/how-it-works/', 'priority' => 0.8, 'frequency' => 'weekly'],

            // Medium priority pages
            ['url' => '/contact/', 'priority' => 0.7, 'frequency' => 'monthly'],
            ['url' => '/gallery/', 'priority' => 0.7, 'frequency' => 'weekly'],
            ['url' => '/testimonials/', 'priority' => 0.6, 'frequency' => 'weekly'],
            ['url' => '/faq/', 'priority' => 0.6, 'frequency' => 'monthly'],
            ['url' => '/team/', 'priority' => 0.6, 'frequency' => 'monthly'],
            ['url' => '/careers/', 'priority' => 0.6, 'frequency' => 'weekly'],
            ['url' => '/digital-wellbeing/', 'priority' => 0.6, 'frequency' => 'weekly'],

            // Legal pages (low priority)
            ['url' => '/privacy-policy/', 'priority' => 0.3, 'frequency' => 'yearly'],
            ['url' => '/terms-and-conditions/', 'priority' => 0.3, 'frequency' => 'yearly'],
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(
                Url::create($page['url'])
                    ->setPriority($page['priority'])
                    ->setChangeFrequency($page['frequency'])
            );
        }

        $this->info('Added static pages to sitemap.');

        // Add all public blogs
        $blogs = Blog::where('is_public', true)
            ->orderBy('date', 'desc')
            ->get();

        foreach ($blogs as $blog) {
            $sitemap->add(
                Url::create('/' . $blog->title_slug)
                    ->setLastModificationDate($blog->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency('monthly')
            );
        }

        $this->info("Added {$blogs->count()} blogs to sitemap.");

        // Add all public services
        $services = Service::where('is_public', true)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($services as $service) {
            $sitemap->add(
                Url::create('/' . $service->title_slug)
                    ->setLastModificationDate($service->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency('monthly')
            );
        }

        $this->info("Added {$services->count()} services to sitemap.");

        // Save sitemap to public directory
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully at: ' . public_path('sitemap.xml'));

        return Command::SUCCESS;
    }
}
