@php($profile = config('site.profile'))

<section class="section contact" id="contact" aria-labelledby="contact-title">
    <div class="shell">
        <x-section-head
            number="06"
            eyebrow="The final chapter"
            eyebrow-key="contact.eyebrow"
            title="Open the next case."
            title-key="contact.title"
            id="contact-title"
            lead="A concise invitation: if the work in these files overlaps with a problem you are solving, start a conversation on GitHub."
            lead-key="contact.lead"
        />

        <div class="contact-panel">
            <div class="contact-copy">
                <p class="contact-kicker" data-i18n="contact.kicker">Collaboration invitation</p>
                <h3 data-i18n="contact.heading">Have a system that needs a spine?</h3>
                <p class="contact-text" data-i18n="contact.text">
                    I am interested in mobile interfaces, Laravel systems, and the architecture between them.
                    Bring a real problem and an honest scope. The fastest way to reach me is a GitHub issue,
                    discussion, or direct message on the profile below.
                </p>
                <p class="contact-availability">
                    <span class="status-dot" aria-hidden="true"></span>
                    <span data-i18n="contact.availability">{{ $profile['availability'] }}</span>
                </p>
            </div>

            <div class="contact-plate">
                <p class="plate-title" data-i18n="contact.channels">Verified channels</p>

                <a
                    class="contact-channel"
                    href="{{ $profile['github'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <span class="contact-channel-icon"><x-site-icon name="github" :size="20" /></span>
                    <span class="contact-channel-copy">
                        <span class="channel-label" data-i18n="contact.github">GitHub</span>
                        <span class="channel-value">{{ $profile['github_label'] }}</span>
                    </span>
                    <x-site-icon name="arrow-up-right" :size="18" />
                    <span class="sr-only" data-i18n="a11y.newTab">(opens in a new tab)</span>
                </a>

                <div class="contact-channel contact-channel--static">
                    <span class="contact-channel-icon"><x-site-icon name="map-pin" :size="20" /></span>
                    <span class="contact-channel-copy">
                        <span class="channel-label" data-i18n="contact.basedIn">Based in</span>
                        <span class="channel-value">{{ $profile['location'] }}</span>
                    </span>
                </div>

                <p class="contact-fineprint" data-i18n="contact.fineprint">
                    No contact form and no email address are published here. GitHub is the only verified
                    channel; an email will be added only when one is confirmed.
                </p>

                <a
                    class="btn btn--ink btn--block"
                    href="{{ $profile['github'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <span data-i18n="contact.cta">Start a conversation</span>
                    <x-site-icon name="arrow-up-right" :size="17" />
                    <span class="sr-only" data-i18n="a11y.newTab">(opens in a new tab)</span>
                </a>
            </div>
        </div>
    </div>
</section>
