import { useBlockProps, RichText } from '@wordpress/block-editor';

export default function save({ attributes }) {
	const blockProps = useBlockProps.save({
		className: 'w-full bg-gradient-to-r from-blue-50 to-blue-100 py-20 md:py-32',
		id: 'home',
	});

	const { buttons = [] } = attributes;

	// Funkcja pomocnicza do pobierania klas CSS na podstawie stylu
	const getButtonClasses = (style) => {
		switch (style) {
			case 'secondary':
				return 'px-6 py-3 rounded-lg font-medium transition-all duration-200 text-sm md:text-base border border-blue-600 text-blue-600 hover:bg-blue-50 flex items-center justify-center';
			case 'primary':
			default:
				return 'px-6 py-3 rounded-lg font-medium transition-all duration-200 text-sm md:text-base bg-blue-600 text-white hover:bg-blue-700 flex items-center justify-center';
		}
	};

	return (
		<section {...blockProps}>
			<div className="container mx-auto px-4">
				<div className="max-w-3xl mx-auto text-center">
					<RichText.Content
						tagName="h1"
						className="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6"
						value={attributes.headline}
					/>
					<RichText.Content
						tagName="p"
						className="text-lg md:text-xl text-gray-700 mb-10"
						value={attributes.description}
					/>

					{buttons.length > 0 && (
						<div className="flex flex-col sm:flex-row justify-center gap-4">
							{buttons.map((button, index) => (
								// Renderuj przycisk tylko jeśli ma tekst i URL
								button.url && button.text && (
									<a key={index} href={button.url}>
										<button className={getButtonClasses(button.style)}>
											{button.text}
											<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" className="lucide lucide-arrow-right ml-2"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
										</button>
									</a>
								)
							))}
						</div>
					)}
				</div>
			</div>
		</section>
	);
}
