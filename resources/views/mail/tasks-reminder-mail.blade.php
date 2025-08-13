@php
    /** @var \App\Models\User $user */
    /** @var \Illuminate\Support\Collection|\App\Models\Task[] $tasks */
    $appUrl = config('app.url');
@endphp
    <!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <title>You Have Overdue Tasks</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if gte mso 9]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->

    <style>
        /* Reset & base */
        html, body { margin:0!important; padding:0!important; height:100%!important; width:100%!important; }
        * { -ms-text-size-adjust:100%; -webkit-text-size-adjust:100%; }
        table, td { mso-table-lspace:0pt!important; mso-table-rspace:0pt!important; }
        table { border-collapse:collapse!important; }
        img { -ms-interpolation-mode:bicubic; border:0; outline:none; text-decoration:none; }
        a { text-decoration:none; }
        /* Mobile */
        @media screen and (max-width:600px){
            .container { width:100%!important; }
            .px-24 { padding-left:16px!important; padding-right:16px!important; }
            .py-24 { padding-top:16px!important; padding-bottom:16px!important; }
            .task-row { padding:12px!important; }
        }
        /* Dark-mode friendly-ish */
        @media (prefers-color-scheme: dark) {
            body, .bg-body { background:#0b0c0e!important; }
            .card { background:#17181b!important; }
            .text { color:#e6e7e9!important; }
            .muted { color:#b0b3b8!important; }
            .divider { border-color:#2b2d31!important; }
            .btn { background:#3b82f6!important; color:#ffffff!important; }
            .pill { background:#2b2d31!important; color:#e6e7e9!important; }
        }
    </style>

    <!-- Preheader (hidden preview text) -->
    <style>
        .preheader { display:none!important; visibility:hidden; opacity:0; color:transparent; height:0; width:0; }
    </style>
</head>
<body class="bg-body" style="background:#f6f7fb;">

<div class="preheader">
    You have {{ sizeof($tasks) }} overdue {{ Str::plural('task', sizeof($tasks)) }} waiting.
</div>

<!-- Wrapper -->
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#f6f7fb;">
    <tr>
        <td align="center" style="padding:24px;">
            <!-- Container -->
            <table role="presentation" width="600" class="container" cellpadding="0" cellspacing="0" border="0" style="width:600px; max-width:100%;">
                <!-- Header -->
                <tr>
                    <td class="px-24 py-24" style="padding:24px;">
                        <table role="presentation" width="100%">
                            <tr>
                                <td align="left" style="font-family:ui-sans-serif, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; font-size:14px; color:#6b7280;">
                    <span style="display:inline-flex; align-items:center; gap:8px;">
                      <!-- Simple logo / wordmark -->
                      <span style="display:inline-block;width:10px;height:10px;border-radius:9999px;background:#3b82f6;"></span>
                      <strong style="color:#111827;">TaskMaster</strong>
                    </span>
                                </td>
                                <td align="right" style="font-family:ui-sans-serif, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; font-size:12px; color:#9ca3af;">
                                    {{ now()->format('M d, Y') }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Card -->
                <tr>
                    <td style="padding:0 24px 24px 24px;">
                        <table role="presentation" width="100%" class="card" cellpadding="0" cellspacing="0" border="0" style="background:#ffffff; border-radius:12px; overflow:hidden; box-shadow:0 10px 25px rgba(17,24,39,0.06);">
                            <tr>
                                <td class="px-24 py-24" style="padding:28px;">
                                    <table role="presentation" width="100%">
                                        <tr>
                                            <td style="font-family:ui-sans-serif, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;">
                                                <h1 class="text" style="margin:0 0 8px 0; font-size:20px; line-height:1.4; color:#111827;">
                                                    Hi {{ $user->name ?? 'there' }},
                                                </h1>
                                                <p class="text muted" style="margin:0 0 16px 0; font-size:14px; line-height:1.6; color:#4b5563;">
                                                    You have {{ sizeof($tasks) }} overdue {{ Str::plural('task', sizeof($tasks)) }}. Please review and complete them as soon as possible.
                                                </p>

                                                <!-- CTA -->
                                                <table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin:16px 0 8px 0;">
                                                    <tr>
                                                        <td>
                                                            <a href="{{ $appUrl }}" target="_blank"
                                                               class="btn"
                                                               style="display:inline-block; background:#111827; color:#ffffff; font-family:ui-sans-serif, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; font-size:14px; font-weight:600; padding:10px 16px; border-radius:8px;">
                                                                View Overdue Tasks
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <!-- Divider -->
                                                <hr class="divider" style="border:none; border-top:1px solid #e5e7eb; margin:20px 0;">

                                                <!-- Task list header -->
                                                <p class="muted" style="margin:0 0 8px 0; font-size:12px; color:#6b7280;">
                                                    Overdue items:
                                                </p>

                                                <!-- Tasks -->
                                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                                    @foreach($tasks as $task)
                                                        @php
                                                            $due = \Illuminate\Support\Carbon::parse($task->due_date);
                                                            $overBy = $due->diffForHumans(now(), ['parts' => 2, 'short' => true, 'syntax' => \Carbon\CarbonInterface::DIFF_ABSOLUTE]);
                                                            $priorityColor = [
                                                              'high' => '#ef4444',
                                                              'medium' => '#f59e0b',
                                                              'low' => '#6b7280',
                                                            ][$task->priority->value ?? (string) $task->priority ?? 'low'] ?? '#6b7280';

                                                            $statusLabel = strtoupper(str_replace('-', ' ', $task->status->value ?? (string) $task->status));
                                                        @endphp
                                                        <tr>
                                                            <td class="task-row" style="padding:14px 0; border-bottom:1px solid #f1f5f9;">
                                                                <table role="presentation" width="100%">
                                                                    <tr>
                                                                        <td width="8" valign="top">
                                                                            <span style="display:inline-block;width:8px;height:8px;border-radius:9999px;background:{{ $priorityColor }};"></span>
                                                                        </td>
                                                                        <td style="padding-left:12px; font-family:ui-sans-serif, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;">
                                                                            <div class="text" style="font-size:14px; color:#111827; font-weight:600;">
                                                                                {{ $task->title }}
                                                                            </div>
                                                                            @if(!empty($task->description))
                                                                                <div class="muted" style="font-size:12px; color:#6b7280; margin-top:2px;">
                                                                                    {{ Str::limit(strip_tags($task->description), 120) }}
                                                                                </div>
                                                                            @endif
                                                                            <div style="margin-top:6px;">
                                          <span class="pill" style="display:inline-block; font-size:11px; color:#374151; background:#f3f4f6; padding:4px 8px; border-radius:9999px;">
                                            Due: {{ $due->format('M d, Y') }} ({{ $overBy }} late)
                                          </span>
                                                                                <span class="pill" style="display:inline-block; font-size:11px; color:#374151; background:#f3f4f6; padding:4px 8px; border-radius:9999px; margin-left:6px;">
                                            Status: {{ $statusLabel }}
                                          </span>
                                                                                <span class="pill" style="display:inline-block; font-size:11px; color:#374151; background:#f3f4f6; padding:4px 8px; border-radius:9999px; margin-left:6px;">
                                            Priority: {{ strtoupper($task->priority->value ?? (string) $task->priority) }}
                                          </span>
                                                                            </div>
                                                                        </td>
                                                                        <td align="right" style="white-space:nowrap; font-family:ui-sans-serif, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif;">
                                                                            <a href="{{ $appUrl }}" target="_blank"
                                                                               style="font-size:12px; color:#3b82f6; font-weight:600;">
                                                                                Open →
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>

                                                <!-- Footer note -->
                                                <p class="muted" style="margin:16px 0 0 0; font-size:12px; color:#6b7280;">
                                                    This reminder is sent because one or more tasks are past due and not marked as done.
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- Footer -->
                <tr>
                    <td class="px-24 py-24" style="padding:12px 24px 24px 24px;">
                        <table role="presentation" width="100%">
                            <tr>
                                <td align="center" style="font-family:ui-sans-serif, -apple-system, Segoe UI, Roboto, Helvetica, Arial, sans-serif; font-size:12px; color:#9ca3af;">
                                    © {{ date('Y') }} TaskMaster — <a href="{{ $appUrl }}" target="_blank" style="color:#6b7280;">{{ parse_url($appUrl, PHP_URL_HOST) }}</a>
                                    <br>
                                    You’re receiving this email because you have an account and notifications are enabled.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

            </table>
            <!-- /Container -->
        </td>
    </tr>
</table>
<!-- /Wrapper -->

</body>
</html>
