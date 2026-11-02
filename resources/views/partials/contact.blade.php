@php($profile = config('site.profile'))

<section class="section contact" id="contact" aria-labelledby="contact-title">
    <div class="shell">
        <x-section-head
            number="06"
            eyebrow="The final chapter"
            title="Open the next case."
            id="contact-title"
            lead="A concise invitation: if the work in these files overlaps with a problem you are solving, start a conversation on GitHub."
        />

        <div class="contact-panel">
            <div class="contact-copy">
                <p class="contact-kicker">Collaboration invitation</p>
                <h3>Have a system that needs a spine?</h3>
                <p class="contact-text">
                    I am interested in mobile interfaces, Laravel systems, and the architecture between them.
                    Bring a real problem and an honest scope. The fastest way to reach me is a GitHub issue,
                    discussion, or direct message on the profile below.
                </p>
                <p class="contact-availability">
                    <span class="status-dot" aria-hidden="true"></span>
                    {{ $profile['availability'] }}
                </p>
            </div>

            <div class="contact-plate">
                <p class="plate-title">Verified channels</p>

                <a
                    class="contact-channel"
                    href="{{ $profile['github'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <span class="contact-channel-icon"><x-site-icon name="github" :size="20" /></span>
                    <span class="contact-channel-copy">
                        <span class="channel-label">GitHub</span>
                        <span class="channel-value">{{ $profile['github_label'] }}</span>
                    </span>
                    <x-site-icon name="arrow-up-right" :size="18" />
                    <span class="sr-only">(opens in a new tab)</span>
                </a>

                <div class="contact-channel contact-channel--static">
                    <span class="contact-channel-icon"><x-site-icon name="map-pin" :size="20" /></span>
                    <span class="contact-channel-copy">
                        <span class="channel-label">Based in</span>
                        <span class="channel-value">{{ $profile['location'] }}</span>
                    </span>
                </div>

                <p class="contact-fineprint">
                    No contact form and no email address are published here. GitHub is the only verified
                    channel; an email will be added only when one is confirmed.
                </p>

                <a
                    class="btn btn--ink btn--block"
                    href="{{ $profile['github'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Start a conversation
                    <x-site-icon name="arrow-up-right" :size="17" />
                    <span class="sr-only">(opens in a new tab)</span>
                </a>
            </div>
        </div>
    </div>
</section>
