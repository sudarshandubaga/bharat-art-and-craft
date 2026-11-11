<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'How long does delivery take for custom furniture orders?',
                'answer' => 'Ready-to-ship catalog items are dispatched within 3-5 business days. Bespoke finishes or customized spatial dimensions are hand-built by our master artisans in our workshops, typically taking between 14-28 business days depending on design complexity.',
                'sort_order' => 1,
                'status' => 'active',
            ],
            [
                'question' => 'Can I customize the dimensions, wood finish, or fabric of any piece?',
                'answer' => 'Yes, bespoke customization is our signature service. You can adjust length, width, height, timber species (Acacia, Sheesham, Teak, White Oak), finishes, and upholstery fabrics. Submit your spatial drawings or requirements on our Customized Enquiry page.',
                'sort_order' => 2,
                'status' => 'active',
            ],
            [
                'question' => 'Are your solid wood materials sustainably certified?',
                'answer' => '100% of our solid hardwood timbers hold strict FSC, PEFC, and Vriksh certifications. We source directly from managed regenerative agricultural plantations where logging is strictly monitored with compulsory replanting protocols.',
                'sort_order' => 3,
                'status' => 'active',
            ],
            [
                'question' => 'How do you prevent solid wood from warping or cracking in dry or cold climates?',
                'answer' => 'Timber seasoning is our core expertise. We operate automatic seasoning kilns that gradually reduce timber moisture content to optimal levels of 8% to 12%. We also engineer expansion relief slots and butterfly joinery keys on wide live-edge slabs, ensuring high resistance to seasonal humidity fluctuations.',
                'sort_order' => 4,
                'status' => 'active',
            ],
            [
                'question' => 'Can I request wood finish samples before placing an order?',
                'answer' => 'Yes. Swatch sets with natural oil finishes (Natural Oak, Dark Smoked, Warm Walnut, and Bleached Ash) plus bouclé and linen fabric samples can be delivered to your door. The sample cost is fully deductible from your future order.',
                'sort_order' => 5,
                'status' => 'active',
            ],
            [
                'question' => 'Do you offer white-glove delivery, crating, and assembly?',
                'answer' => 'Yes! Large furniture orders include optional White-Glove delivery. Every piece is wrapped in multi-layered foam sheets, heavy corner protectors, 7-ply corrugated cartons, and custom wooden pallet crates. Our logistics partners carry items into your room of choice, assemble, and remove packaging.',
                'sort_order' => 6,
                'status' => 'active',
            ],
            [
                'question' => 'What warranty do you offer on your furniture?',
                'answer' => 'Every solid wood piece comes with our 10-Year Craft Warranty covering internal joinery, structural framework, and wood stability under regular indoor conditions.',
                'sort_order' => 7,
                'status' => 'active',
            ],
            [
                'question' => 'Do you handle international export container shipments?',
                'answer' => 'Yes. We are a government-registered furniture exporter serving wholesale buyers, architects, luxury resorts, and retail brands across North America, Europe, Australia, and the Middle East in 20ft and 40ft Full Container Loads (FCL).',
                'sort_order' => 8,
                'status' => 'active',
            ],
        ];

        foreach ($faqs as $f) {
            Faq::updateOrCreate(
                ['question' => $f['question']],
                $f
            );
        }
    }
}

