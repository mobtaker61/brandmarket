<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>گزارش تحلیل برندها</title>
    <style>
        body {
            font-family: 'Tahoma', 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            direction: rtl;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #1f2937;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #6b7280;
            margin: 10px 0 0 0;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: #f8fafc;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        .stat-number {
            font-size: 32px;
            font-weight: bold;
            color: #3b82f6;
            margin-bottom: 5px;
        }
        .stat-label {
            color: #64748b;
            font-size: 14px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            color: #1f2937;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .chart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f1f5f9;
        }
        .chart-item:last-child {
            border-bottom: none;
        }
        .chart-name {
            font-weight: 500;
            color: #374151;
        }
        .chart-count {
            font-weight: bold;
            color: #059669;
        }
        .progress-bar {
            width: 100px;
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
            margin: 0 10px;
        }
        .progress-fill {
            height: 100%;
            background: #3b82f6;
            border-radius: 4px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>گزارش تحلیل برندها</h1>
            <p>تاریخ تولید: {{ $data['generatedAt'] }}</p>
        </div>

        <!-- آمار کلی -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $data['totalBrands'] }}</div>
                <div class="stat-label">کل برندها</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $data['activeBrands'] }}</div>
                <div class="stat-label">برندهای فعال</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $data['inactiveBrands'] }}</div>
                <div class="stat-label">برندهای غیرفعال</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    {{ $data['totalBrands'] > 0 ? round(($data['activeBrands'] / $data['totalBrands']) * 100, 1) : 0 }}%
                </div>
                <div class="stat-label">نرخ فعال بودن</div>
            </div>
        </div>

        <!-- آمار دسته‌بندی‌ها -->
        <div class="section">
            <h2>توزیع برندها بر اساس دسته‌بندی</h2>
            @forelse($data['categoryStats'] as $category)
                <div class="chart-item">
                    <span class="chart-name">{{ $category['name'] }}</span>
                    <div style="display: flex; align-items: center;">
                        <div class="progress-bar">
                            @php
                                $percentage = $data['totalBrands'] > 0 ? ($category['count'] / $data['totalBrands']) * 100 : 0;
                            @endphp
                            <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="chart-count">{{ $category['count'] }}</span>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #6b7280;">هیچ داده‌ای موجود نیست</p>
            @endforelse
        </div>

        <!-- آمار کشورها -->
        <div class="section">
            <h2>توزیع برندها بر اساس کشور</h2>
            @forelse($data['countryStats'] as $country)
                <div class="chart-item">
                    <span class="chart-name">{{ $country['name'] }}</span>
                    <div style="display: flex; align-items: center;">
                        <div class="progress-bar">
                            @php
                                $percentage = $data['totalBrands'] > 0 ? ($country['count'] / $data['totalBrands']) * 100 : 0;
                            @endphp
                            <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="chart-count">{{ $country['count'] }}</span>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #6b7280;">هیچ داده‌ای موجود نیست</p>
            @endforelse
        </div>

        <!-- آمار وضعیت برندها -->
        <div class="section">
            <h2>توزیع برندها بر اساس وضعیت</h2>
            @forelse($data['statusStats'] as $status)
                <div class="chart-item">
                    <span class="chart-name">{{ $status['name'] }}</span>
                    <div style="display: flex; align-items: center;">
                        <div class="progress-bar">
                            @php
                                $percentage = $data['totalBrands'] > 0 ? ($status['count'] / $data['totalBrands']) * 100 : 0;
                            @endphp
                            <div class="progress-fill" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="chart-count">{{ $status['count'] }}</span>
                    </div>
                </div>
            @empty
                <p style="text-align: center; color: #6b7280;">هیچ داده‌ای موجود نیست</p>
            @endforelse
        </div>

        <div class="footer">
            <p>این گزارش توسط سیستم مدیریت برند تولید شده است</p>
        </div>
    </div>
</body>
</html>
