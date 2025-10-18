<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Barangay 50 Citizens Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 100%;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #0284C7;
            padding-bottom: 15px;
        }

        .header h1 {
            font-size: 28px;
            color: #0284C7;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .filter-info {
            background-color: #F0F9FF;
            border-left: 4px solid #0284C7;
            padding: 12px 15px;
            margin-bottom: 20px;
            font-size: 13px;
            color: #0C4A6E;
        }

        .filter-info strong {
            color: #075985;
        }

        .stats-row {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            justify-content: space-around;
        }

        .stat-box {
            background-color: #F8FAFC;
            border: 1px solid #E2E8F0;
            padding: 12px 20px;
            border-radius: 6px;
            text-align: center;
            flex: 1;
        }

        .stat-box .number {
            font-size: 24px;
            font-weight: bold;
            color: #0284C7;
        }

        .stat-box .label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        thead {
            background-color: #0284C7;
            color: white;
        }

        th {
            padding: 12px 8px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #0284C7;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #E2E8F0;
        }

        tbody tr:nth-child(odd) {
            background-color: #F8FAFC;
        }

        tbody tr:hover {
            background-color: #F0F9FF;
        }

        .name-cell {
            font-weight: 600;
            color: #1E293B;
        }

        .age-badge {
            background-color: #DBEAFE;
            color: #075985;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
        }

        .category-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            color: white;
            margin-right: 4px;
            margin-bottom: 2px;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #E2E8F0;
            text-align: center;
            font-size: 11px;
            color: #999;
        }

        .footer p {
            margin: 5px 0;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 14px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>BARANGAY 50 - CITIZEN REGISTRY</h1>
            <p>Tacloban City, Leyte, Philippines</p>
            <p style="font-size: 12px; margin-top: 10px;">
                Generated on {{ \Carbon\Carbon::now('Asia/Manila')->format('F d, Y \a\t g:i A') }} (PHT)
            </p>
        </div>

        <!-- Filter Information -->
        <div class="filter-info">
            <strong>Report Scope:</strong> {{ $filterDescription }}
        </div>

        <!-- Statistics -->
        @if ($citizens->count() > 0)
            <div class="stats-row">
                <div class="stat-box">
                    <div class="number">{{ $citizens->count() }}</div>
                    <div class="label">Total Citizens</div>
                </div>
                <div class="stat-box">
                    <div class="number">{{ $citizens->where('gender', 'Male')->count() }}</div>
                    <div class="label">Male</div>
                </div>
                <div class="stat-box">
                    <div class="number">{{ $citizens->where('gender', 'Female')->count() }}</div>
                    <div class="label">Female</div>
                </div>
                <div class="stat-box">
                    <div class="number">{{ $citizens->where('gender', 'Other')->count() }}</div>
                    <div class="label">Other</div>
                </div>
            </div>

            <!-- Citizen Table -->
            <table>
                <thead>
                    <tr>
                        <th style="width: 25%;">Full Name</th>
                        @if ($columns['gender'] ?? true)
                            <th style="width: 8%;">Gender</th>
                        @endif
                        @if ($columns['age'] ?? true)
                            <th style="width: 8%;">Age</th>
                        @endif
                        @if ($columns['birthdate'] ?? false)
                            <th style="width: 12%;">Birthdate</th>
                        @endif
                        @if ($columns['civil_status'] ?? true)
                            <th style="width: 12%;">Civil Status</th>
                        @endif
                        @if ($columns['contact'] ?? true)
                            <th style="width: 15%;">Contact</th>
                        @endif
                        @if ($columns['pcn'] ?? true)
                            <th style="width: 10%;">PhilSys Card Number</th>
                        @endif
                        @if ($columns['occupation'] ?? false)
                            <th style="width: 12%;">Occupation</th>
                        @endif
                        @if ($columns['status'] ?? false)
                            <th style="width: 8%;">Status</th>
                        @endif
                        @if ($columns['categories'] ?? true)
                            <th style="width: 15%;">Categories</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($citizens as $citizen)
                        <tr>
                            <td>
                                <div class="name-cell">{{ $citizen->full_name }}</div>
                                <div style="font-size: 10px; color: #999;">{{ $citizen->address }}</div>
                            </td>
                            @if ($columns['gender'] ?? true)
                                <td>{{ $citizen->gender ?? 'Not specified' }}</td>
                            @endif
                            @if ($columns['age'] ?? true)
                                <td>
                                    <span class="age-badge">{{ $citizen->age ?? 'N/A' }}</span>
                                </td>
                            @endif
                            @if ($columns['birthdate'] ?? false)
                                <td style="font-size: 11px;">{{ $citizen->birthdate ? $citizen->birthdate->format('M d, Y') : 'Not specified' }}</td>
                            @endif
                            @if ($columns['civil_status'] ?? true)
                                <td style="font-size: 11px;">{{ $citizen->civil_status ?? 'Not specified' }}</td>
                            @endif
                            @if ($columns['contact'] ?? true)
                                <td style="font-size: 11px;">
                                    @if ($citizen->email)
                                        <div>{{ $citizen->email }}</div>
                                    @endif
                                    @if ($citizen->phone)
                                        <div>{{ $citizen->phone }}</div>
                                    @endif
                                </td>
                            @endif
                            @if ($columns['pcn'] ?? true)
                                <td style="font-size: 11px;">{{ $citizen->pcn ?? '—' }}</td>
                            @endif
                            @if ($columns['occupation'] ?? false)
                                <td style="font-size: 11px;">{{ $citizen->occupation ?? '—' }}</td>
                            @endif
                            @if ($columns['status'] ?? false)
                                <td style="font-size: 11px;">
                                    <span style="padding: 2px 4px; border-radius: 3px; {{ $citizen->status === 'active' ? 'background-color: #DCFCE7; color: #166534;' : 'background-color: #F3F4F6; color: #6B7280;' }}">
                                        {{ ucfirst($citizen->status ?? 'active') }}
                                    </span>
                                </td>
                            @endif
                            @if ($columns['categories'] ?? true)
                                <td>
                                    @forelse ($citizen->categories as $category)
                                        <span class="category-badge" style="background-color: {{ $category->color }}">
                                            {{ $category->name }}
                                        </span>
                                    @empty
                                        <span style="color: #999; font-size: 11px;">—</span>
                                    @endforelse
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Footer -->
            <div class="footer">
                <p><strong>Barangay 50 Mulopyo Management</strong></p>
                <p>©Nikko Rodriguez Villas 2025</p>
                <p>Report ID: {{ uniqid() }} | Page 1 of 1</p>
            </div>
        @else
            <div class="empty-state">
                <p>No citizens found matching the selected criteria.</p>
            </div>
        @endif
    </div>
</body>
</html>
